<?php

use Illuminate\Support\Facades\Route;

include __DIR__ . '/livewire.php';

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('admin', function () {
        return view('pages.admin.dashboard');
    })->name('admin');


});
