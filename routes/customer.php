<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\AuthManager;
use App\Http\Controllers\Customer\RegisterController;
use App\Http\Controllers\Customer\LoginController;
use App\Http\Middleware\RedirectIfNotAuthenticated;
use App\Http\Middleware\RedirectIfAuthenticated;


Route::get('/', [CustomerController::class, 'index'])->name('customer.index');


Route::middleware([RedirectIfAuthenticated::class . ':customer'])->group(function () {
    Route::get('/cliente/login', [LoginController::class, 'login'])->name('customer.login');
    Route::post('/cliente/login', [LoginController::class, 'loginPost'])->name('customer.login.post');

    Route::get('/cliente/register', [RegisterController::class, 'register'])->name('customer.register');
    Route::post('/cliente/register', [RegisterController::class, 'registerPost'])->name('customer.register.post');
});


Route::middleware([RedirectIfNotAuthenticated::class . ':customer'])->group(function () {
    Route::post('cliente/logout', [AuthManager::class, 'logout'])->name('customer.logout');
});
