<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Roles;

include __DIR__ . '/livewire.php';

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('pages.dashboard');
    })->name('/');
    Route::get('roles', function () {
        return view('pages.roles.index');
    })->name('roles.index');
    Route::get('roles/create', Roles\Create::class)->name('roles.create');
    Route::get('/roles/{role}/edit', Roles\Update::class)->name('roles.edit');
    Route::get('/roles/{role}', Roles\Detail::class)->name('roles.show');
});
