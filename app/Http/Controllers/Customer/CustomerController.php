<?php

namespace App\Http\Controllers\Customer;


use App\Models\Featured;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        $featured = Featured::where('id', 1)->first();

        return view('pages.customer.index', compact('featured'));
    }

    public function addresses()
    {
        return view('pages.customer.user.addresses');
    }

}
