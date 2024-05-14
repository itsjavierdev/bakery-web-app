<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Featured;

class CustomerController extends Controller
{
    public function index()
    {
        $featured = Featured::where('id', 1)->first();

        return view('pages.customer.index', compact('featured'));
    }

    public function test()
    {

        return view('pages.customer.test');
    }

}
