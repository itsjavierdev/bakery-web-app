<?php

namespace App\Http\Controllers\Customer;


use App\Models\Featured;
use App\Http\Controllers\Controller;
use App\Models\Product;

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

    public function shop()
    {
        return view('pages.customer.products.shop');
    }

    public function showProduct($productSlug)
    {
        $product = Product::where('slug', $productSlug)->first();

        return view('pages.customer.products.detail', compact('product'));
    }

    public function cart()
    {
        return view('pages.customer.cart.index');
    }

}
