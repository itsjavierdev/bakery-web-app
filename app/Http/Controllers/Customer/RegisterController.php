<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use App\Models\CustomerAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;

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
            'customer_id' => $customer->id,
        ]);

        if ($customer && $user) {
            return redirect()->route('customer.login')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Gracias por registrarse. Nos pondremos en contacto con usted en las proximas 24 horas para verificar su cuenta.');
        } else {
            return redirect()->route('customer.register')->with('error', 'Algo salió mal, intente nuevamente');
        }
    }

}
