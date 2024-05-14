<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthCustomerManager;
use App\Http\Controllers\Customer\RegisterController;
use App\Http\Middleware\RedirectIfNotAuthenticated;


Route::get('/', [CustomerController::class, 'index'])->name('customer.index');

Route::get('/login', [AuthCustomerManager::class, 'login'])->name('customer.login');
Route::post('/login', [AuthCustomerManager::class, 'loginPost'])->name('customer.login.post');


Route::get('/register', [RegisterController::class, 'register'])->name('customer.register');
Route::post('/register', [RegisterController::class, 'registerPost'])->name('customer.register.post');

Route::middleware([RedirectIfNotAuthenticated::class . ':customer'])->group(function () {
    Route::get('/test', [CustomerController::class, 'test'])->name('customer.test');
    Route::post('customer/logout', [AuthCustomerManager::class, 'logout'])->name('customer.logout');
});
