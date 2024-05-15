<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthManager extends Controller
{
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->to('/');
    }
}
