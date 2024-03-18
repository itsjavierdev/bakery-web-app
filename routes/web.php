<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Roles;
use App\Livewire\Staff;

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
});
