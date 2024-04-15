<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Roles;
use App\Livewire\Admin\Staff;
use App\Livewire\Admin\Categories;
use App\Livewire\Admin\Products;
use App\Livewire\Admin\DeliveryTimes;
use App\Livewire\Admin\Customers;

include __DIR__ . '/livewire.php';

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('admin', function () {
        return view('pages.dashboard');
    })->name('/');
    //Role routes
    Route::get('admin/roles', function () {
        return view('pages.admin.roles.index');
    })->name('roles.index');
    Route::get('admin/roles/create', Roles\Create::class)->name('roles.create');
    Route::get('admin/roles/{role}/edit', Roles\Update::class)->name('roles.edit');
    Route::get('admin/roles/{role}', Roles\Detail::class)->name('roles.show');

    //Staff routes
    Route::get('admin/personal', function () {
        return view('pages.admin.staff.index');
    })->name('personal.index');
    Route::get('admin/personal/create', Staff\Create::class)->name('personal.create');
    Route::get('admin/personal/{staff}/edit', Staff\Update::class)->name('personal.edit');
    Route::get('admin/personal/{staff}', Staff\Detail::class)->name('personal.show');

    //Categories routes
    Route::get('admin/categorias', function () {
        return view('pages.admin.categories.index');
    })->name('categorias.index');
    Route::get('admin/categorias/create', Categories\Create::class)->name('categorias.create');
    Route::get('admin/categorias/{category}/edit', Categories\Update::class)->name('categorias.edit');
    Route::get('admin/categorias/{category}', Categories\Detail::class)->name('categorias.show');

    //Categories routes
    Route::get('admin/productos', function () {
        return view('pages.admin.products.index');
    })->name('productos.index');
    Route::get('admin/productos/create', Products\Create::class)->name('productos.create');
    Route::get('admin/productos/{product}/edit', Products\Update::class)->name('productos.edit');
    Route::get('admin/productos/{product}', Products\Detail::class)->name('productos.show');

    //Delivery Times routes
    Route::get('admin/horarios', function () {
        return view('pages.admin.delivery-times.index');
    })->name('horarios.index');
    Route::get('admin/horarios/create', DeliveryTimes\Create::class)->name('horarios.create');
    Route::get('admin/horarios/{deliverytime}/edit', DeliveryTimes\Update::class)->name('horarios.edit');
    Route::get('admin/horarios/{deliverytime}', DeliveryTimes\Detail::class)->name('horarios.show');

    //Customer routes
    Route::get('admin/clientes', function () {
        return view('pages.admin.customers.index');
    })->name('clientes.index');
    Route::get('admin/clientes/create', Customers\Create::class)->name('clientes.create');
    Route::get('admin/clientes/{customer}/edit', Customers\Update::class)->name('clientes.edit');
    Route::get('admin/clientes/{customer}', Customers\Detail::class)->name('clientes.show');
});
