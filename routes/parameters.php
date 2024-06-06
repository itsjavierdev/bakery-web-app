<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Parameters\Categories;
use App\Livewire\Admin\Parameters\Products;
use App\Livewire\Admin\Parameters\DeliveryTimes;
use App\Livewire\Admin\Parameters\CompanyContact;
use App\Livewire\Admin\Parameters\Featured;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //Categories routes
    Route::get('admin/categorias', function () {
        return view('pages.admin.parameters.categories.index');
    })->name('categories.index');
    Route::get('admin/categorias/create', Categories\Create::class)->name('categories.create');
    Route::get('admin/categorias/{category}/edit', Categories\Update::class)->name('categories.edit');
    Route::get('admin/categorias/{category}', Categories\Detail::class)->name('categories.show');

    //Products routes
    Route::get('admin/productos', function () {
        return view('pages.admin.parameters.products.index');
    })->name('products.index');
    Route::get('admin/productos/create', Products\Create::class)->name('products.create');
    Route::get('admin/productos/{product}/edit', Products\Update::class)->name('products.edit');
    Route::get('admin/productos/{product}', Products\Detail::class)->name('products.show');

    //Delivery Times routes
    Route::get('admin/horarios', function () {
        return view('pages.admin.parameters.delivery-times.index');
    })->name('deliverytimes.index');
    Route::get('admin/horarios/create', DeliveryTimes\Create::class)->name('deliverytimes.create');
    Route::get('admin/horarios/{deliverytime}/edit', DeliveryTimes\Update::class)->name('deliverytimes.edit');
    Route::get('admin/horarios/{deliverytime}', DeliveryTimes\Detail::class)->name('deliverytimes.show');

    //Company contact routes
    Route::get('admin/informacion', function () {
        return view('pages.admin.parameters.company-contact.index');
    })->name('company-contact.index');
    Route::get('admin/información/edit', CompanyContact\Update::class)->name('company-contact.edit');

    //Featured routes
    Route::get('admin/destacados', function () {
        return view('pages.admin.parameters.featured.index');
    })->name('featured.index');
    Route::get('admin/destacados/create', Featured\Create::class)->name('featured.create');
    Route::get('admin/destacados/reordenar', Featured\Reorder::class)->name('featured.reorder');
    Route::get('admin/destacados/{featured}/edit', Featured\Update::class)->name('featured.edit');
    Route::get('admin/destacados/{featured}', Featured\Detail::class)->name('featured.show');

});