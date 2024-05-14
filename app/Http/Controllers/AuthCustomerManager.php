<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerAccount;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;

class AuthCustomerManager extends Controller
{
    use PasswordValidationRules;

    public function login()
    {
        return view('pages.customer.auth.login');
    }

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
        ]);

        $user = CustomerAccount::create([
            'password' => $data['password'],
            'customer_id' => $customer->id,
        ]);

        if ($customer && $user) {
            return redirect()->route('customer.login');
        } else {
            return redirect()->route('customer.register')->with('error', 'Algo salió mal');
        }
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if ($customer) {
            $customerAccount = CustomerAccount::where('customer_id', $customer->id)->first();

            if ($customerAccount && Auth::guard('customer')->attempt(['id' => $customerAccount->id, 'password' => $request->password])) {
                return redirect()->route('customer.index');
            }
        }

        return redirect()->route('customer.login')->withErrors(['email' => 'Credenciales incorrectas']);
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->to('/');
    }
}
