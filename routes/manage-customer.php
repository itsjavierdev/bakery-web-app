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
    })->name('customers.index');
    Route::get('admin/clientes/create', Customers\Create::class)->name('customers.create');
    Route::get('admin/clientes/{customer}/edit', Customers\Update::class)->name('customers.edit');
    Route::get('admin/clientes/{customer}', Customers\Detail::class)->name('customers.show');


});