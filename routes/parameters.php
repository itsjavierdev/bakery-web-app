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
    })->middleware('can:categories.read')->name('categories.index');
    Route::get('admin/categorias/create', Categories\Create::class)->middleware('can:categories.create')->name('categories.create');
    Route::get('admin/categorias/{category}/edit', Categories\Update::class)->middleware('can:categories.update')->name('categories.edit');
    Route::get('admin/categorias/{category}', Categories\Detail::class)->middleware('can:categories.read')->name('categories.show');

    //Products routes
    Route::get('admin/productos', function () {
        return view('pages.admin.parameters.products.index');
    })->middleware('can:products.read')->name('products.index');
    Route::get('admin/productos/create', Products\Create::class)->middleware('can:products.create')->name('products.create');
    Route::get('admin/productos/{product}/edit', Products\Update::class)->middleware('can:products.update')->name('products.edit');
    Route::get('admin/productos/{product}', Products\Detail::class)->middleware('can:products.read')->name('products.show');

    //Delivery Times routes
    Route::get('admin/horarios', function () {
        return view('pages.admin.parameters.delivery-times.index');
    })->middleware('can:deliverytimes.read')->name('deliverytimes.index');
    Route::get('admin/horarios/create', DeliveryTimes\Create::class)->middleware('can:deliverytimes.create')->name('deliverytimes.create');
    Route::get('admin/horarios/{deliverytime}/edit', DeliveryTimes\Update::class)->middleware('can:deliverytimes.update')->name('deliverytimes.edit');
    Route::get('admin/horarios/{deliverytime}', DeliveryTimes\Detail::class)->middleware('can:deliverytimes.read')->name('deliverytimes.show');

    //Company contact routes
    Route::get('admin/informacion', function () {
        return view('pages.admin.parameters.company-contact.index');
    })->middleware('can:companycontact.read')->name('companycontact.index');
    Route::get('admin/información/edit', CompanyContact\Update::class)->middleware('can:companycontact.update')->name('companycontact.edit');

    //Featured routes
    Route::get('admin/destacados', function () {
        return view('pages.admin.parameters.featured.index');
    })->middleware('can:featured.read')->name('featured.index');
    Route::get('admin/destacados/create', Featured\Create::class)->middleware('can:featured.create')->name('featured.create');
    Route::get('admin/destacados/reordenar', Featured\Reorder::class)->middleware('can:featured.update')->name('featured.reorder');
    Route::get('admin/destacados/{featured}/edit', Featured\Update::class)->middleware('can:featured.update')->name('featured.edit');
    Route::get('admin/destacados/{featured}', Featured\Detail::class)->middleware('can:featured.read')->name('featured.show');

});