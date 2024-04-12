<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Roles;
use App\Livewire\Admin\Staff;
use App\Livewire\Admin\Categories;
use App\Livewire\Admin\Products;
use App\Livewire\Admin\DeliveryTimes;

include __DIR__ . '/livewire.php';

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('pages.dashboard');
    })->name('/');
    //Role routes
    Route::get('roles', function () {
        return view('pages.admin.roles.index');
    })->name('roles.index');
    Route::get('roles/create', Roles\Create::class)->name('roles.create');
    Route::get('/roles/{role}/edit', Roles\Update::class)->name('roles.edit');
    Route::get('/roles/{role}', Roles\Detail::class)->name('roles.show');

    //Staff routes
    Route::get('personal', function () {
        return view('pages.admin.staff.index');
    })->name('personal.index');
    Route::get('personal/create', Staff\Create::class)->name('personal.create');
    Route::get('/personal/{staff}/edit', Staff\Update::class)->name('personal.edit');
    Route::get('/personal/{staff}', Staff\Detail::class)->name('personal.show');

    //Categories routes
    Route::get('categorias', function () {
        return view('pages.admin.categories.index');
    })->name('categorias.index');
    Route::get('categorias/create', Categories\Create::class)->name('categorias.create');
    Route::get('/categorias/{category}/edit', Categories\Update::class)->name('categorias.edit');
    Route::get('/categorias/{category}', Categories\Detail::class)->name('categorias.show');

    //Categories routes
    Route::get('productos', function () {
        return view('pages.admin.products.index');
    })->name('productos.index');
    Route::get('productos/create', Products\Create::class)->name('productos.create');
    Route::get('/productos/{product}/edit', Products\Update::class)->name('productos.edit');
    Route::get('/productos/{product}', Products\Detail::class)->name('productos.show');

    //Delivery Times routes
    Route::get('horarios', function () {
        return view('pages.admin.delivery-times.index');
    })->name('horarios.index');
    Route::get('horarios/create', DeliveryTimes\Create::class)->name('horarios.create');
    Route::get('/horarios/{deliverytime}/edit', DeliveryTimes\Update::class)->name('horarios.edit');
    Route::get('/horarios/{deliverytime}', DeliveryTimes\Detail::class)->name('horarios.show');
});
