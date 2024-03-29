<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Roles;
use App\Livewire\Staff;
use App\Livewire\Categories;

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
        return view('pages.roles.index');
    })->name('roles.index');
    Route::get('roles/create', Roles\Create::class)->name('roles.create');
    Route::get('/roles/{role}/edit', Roles\Update::class)->name('roles.edit');
    Route::get('/roles/{role}', Roles\Detail::class)->name('roles.show');

    //Staff routes
    Route::get('personal', function () {
        return view('pages.staff.index');
    })->name('personal.index');
    Route::get('personal/create', Staff\Create::class)->name('personal.create');
    Route::get('/personal/{staff}/edit', Staff\Update::class)->name('personal.edit');
    Route::get('/personal/{staff}', Staff\Detail::class)->name('personal.show');

    //Categories routes
    Route::get('categorias', function () {
        return view('pages.categories.index');
    })->name('categorias.index');
    Route::get('categorias/create', Categories\Create::class)->name('categorias.create');
    Route::get('/categorias/{category}/edit', Categories\Update::class)->name('categorias.edit');
    Route::get('/categorias/{category}', Categories\Detail::class)->name('categorias.show');
});
