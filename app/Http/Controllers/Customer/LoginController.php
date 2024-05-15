<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('pages.customer.auth.login');
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

                $previousUrl = Session::get('previous_url', '/');
                Session::forget('previous_url');
                return redirect()->to($previousUrl);
            }
        }

        return redirect()->route('customer.login')->withErrors(['email' => 'Credenciales incorrectas']);
    }
}
