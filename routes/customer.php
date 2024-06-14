<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\AuthManager;
use App\Http\Controllers\Customer\RegisterController;
use App\Http\Controllers\Customer\LoginController;
use App\Http\Middleware\RedirectIfNotAuthenticated;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfCartIsEmpty;
use App\Http\Middleware\CheckVerified;


Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
Route::get('shop', [CustomerController::class, 'shop'])->name('customer.shop');
Route::get('/producto/{productSlug}', [CustomerController::class, 'showProduct'])->name('show-product');


Route::middleware([RedirectIfAuthenticated::class . ':customer'])->group(function () {
    Route::get('/cliente/login', [LoginController::class, 'login'])->name('customer.login');
    Route::post('/cliente/login', [LoginController::class, 'loginPost'])->name('customer.login.post');

    Route::get('/cliente/register', [RegisterController::class, 'register'])->name('customer.register');
    Route::post('/cliente/register', [RegisterController::class, 'registerPost'])->name('customer.register.post');
});


Route::middleware([RedirectIfNotAuthenticated::class . ':customer'])->group(function () {
    Route::post('cliente/logout', [AuthManager::class, 'logout'])->name('customer.logout');
    Route::get('cliente/direcciones', [CustomerController::class, 'addresses'])->name('customer.addresses');
    Route::get('cliente/realizar-pedido', [CustomerController::class, 'checkout'])->middleware([RedirectIfCartIsEmpty::class, CheckVerified::class . ':customer'])->name('customer.checkout');
    Route::get('cliente/muchas-gracias', [CustomerController::class, 'thankyou'])->name('customer.thankyou');
    Route::get('cliente/no-verificado', [CustomerController::class, 'notVerified'])->name('customer.not.verified');
    Route::get('/carrito', [CustomerController::class, 'cart'])->middleware([CheckVerified::class . ':customer'])->name('cart');
});
