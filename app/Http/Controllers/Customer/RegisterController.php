<?php

namespace App\Http\Controllers\Customer;

use App\Mail\CustomerPending;
use App\Mail\NewCustomer;
use App\Models\Customer;
use App\Models\CustomerAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    use PasswordValidationRules;

    public function register()
    {
        return view('pages.customer.auth.register');
    }
    public function registerPost(Request $request)
    {

        $request->validate([
            'name' => 'required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25',
            'surname' => 'required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25',
            'phone' => 'required|integer|min:60000000|max:80090000|unique:customers,phone',
            'email' => 'required|string|email|max:255|unique:customers,email',
            'password' => $this->passwordRules(),
        ], [
            'name.required' => 'El campo nombre es requerido',
            'name.regex' => 'El campo nombre solo puede contener letras',
            'name.min' => 'El campo nombre debe tener al menos 3 caracteres',
            'name.max' => 'El campo nombre debe tener como máximo 25 caracteres',
            'surname.required' => 'El campo apellido es requerido',
            'surname.regex' => 'El campo apellido solo puede contener letras',
            'surname.min' => 'El campo apellido debe tener al menos 3 caracteres',
            'surname.max' => 'El campo apellido debe tener como máximo 25 caracteres',
            'phone.required' => 'El campo teléfono es requerido',
            'phone.integer' => 'El campo teléfono solo puede contener números',
            'phone.min' => 'El teléfono no es valido',
            'phone.max' => 'El teléfono no es valido',
            'phone.unique' => 'El teléfono ya está en uso',
            'email.required' => 'El campo email es requerido',
            'email.string' => 'El campo email solo puede contener letras',
            'email.email' => 'El campo email debe ser un email válido',
            'email.max' => 'El campo email debe tener como máximo 255 caracteres',
            'email.unique' => 'El email ya está en uso',
            'password.required' => 'El campo contraseña es requerido',
            'password.min' => 'El campo contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
        ]);

        $data['name'] = $request->name;
        $data['surname'] = $request->surname;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        $customer = Customer::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'verified' => '0',
        ]);

        $user = CustomerAccount::create([
            'password' => $data['password'],
            'email' => $data['email'],
            'customer_id' => $customer->id,
        ]);

        Auth::guard('customer')->login($user);
        event(new Registered($user));

        if ($customer && $user) {
            return redirect()->route('customer.index')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Gracias por registrarse. Se le envio un correo de verificación.');
        } else {
            return redirect()->route('customer.register')->with('error', 'Algo salió mal, intente nuevamente');
        }
    }
    public function registerPhone()
    {
        $customer = Customer::find(session('customer_id'));

        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'Ocurrió un error, intenta nuevamente.');
        }

        $firstName = explode(' ', trim($customer->name))[0] ?? '';

        return view('pages.customer.auth.add-phone', compact('customer', 'firstName'));
    }

    public function registerFinish(Request $request)
    {
        $request->validate([
            'phone' => 'required|integer|min:60000000|max:80090000|unique:customers,phone',
            'name' => 'required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25',
            'surname' => 'required|regex:/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/|min:3|max:25',
        ], [
            'phone.required' => 'El campo teléfono es requerido',
            'phone.integer' => 'El campo teléfono solo puede contener números',
            'phone.min' => 'El teléfono no es valido',
            'phone.max' => 'El teléfono no es valido',
            'phone.unique' => 'El teléfono ya está en uso',
            'name.required' => 'El campo nombre es requerido',
            'name.regex' => 'El campo nombre solo puede contener letras',
            'name.min' => 'El campo nombre debe tener al menos 3 caracteres',
            'name.max' => 'El campo nombre debe tener como máximo 25 caracteres',
            'surname.required' => 'El campo apellido es requerido',
            'surname.regex' => 'El campo apellido solo puede contener letras',
            'surname.min' => 'El campo apellido debe tener al menos 3 caracteres',
            'surname.max' => 'El campo apellido debe tener como máximo 25 caracteres',
        ]);

        $customer = Customer::find(session('customer_id'));

        if (!$customer) {
            return redirect()->route('customer.login')->with('error', 'Ocurrió un error, intenta nuevamente.');
        }

        $customer->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'phone' => $request->phone,
        ]);

        $customeAccount = CustomerAccount::where('customer_id', $customer->id)->first();

        Auth::guard('customer')->login($customeAccount);

        Mail::to($customer->email)->send(new CustomerPending($customer));
        Mail::to('contact@sanxavier.com')->send(new NewCustomer($customer));

        return redirect()->route('customer.index')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Gracias por registrarte. Revisaremos tu información y nos pondremos en contacto en las próximas 24 horas para activar tu cuenta.');
    }

}
