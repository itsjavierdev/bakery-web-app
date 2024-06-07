<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ManagementCustomers\Customers;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //Customer routes
    Route::get('admin/clientes', function () {
        return view('pages.admin.management-customers.customers.index');
    })->middleware('can:customers.read')->name('customers.index');
    Route::get('admin/clientes/create', Customers\Create::class)->middleware('can:customers.create')->name('customers.create');
    Route::get('admin/clientes/{customer}/edit', Customers\Update::class)->middleware('can:customers.update')->name('customers.edit');
    Route::get('admin/clientes/{customer}', Customers\Detail::class)->middleware('can:customers.read')->name('customers.show');


});