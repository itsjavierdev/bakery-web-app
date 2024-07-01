<?php

use App\Mail\NewCustomer;
use App\Mail\VerifiedCustomerPending;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\AuthManager;
use App\Http\Controllers\Customer\RegisterController;
use App\Http\Controllers\Customer\LoginController;
use App\Http\Middleware\RedirectIfNotAuthenticated;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfCartIsEmpty;
use App\Http\Middleware\CheckVerified;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;
use App\Models\CustomerAccount;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->stateless()->user();


    $customer = Customer::updateOrCreate([
        'email' => $user_google->email
    ], [
        'name' => $user_google->name
    ]);

    $customerAccount = CustomerAccount::updateOrCreate([
        'customer_id' => $customer->id
    ], [
        'google_id' => $user_google->id,
        'email_verified_at' => now()
    ]);

    if (!$customer->phone) {
        Session::put('customer_id', $customer->id);
        return redirect()->route('customer.register.phone');
    }

    Auth::guard('customer')->login($customerAccount);


    $previousUrl = Session::get('previous_url', '/');
    Session::forget('previous_url');
    return redirect()->to($previousUrl);
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth:customer')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    $customer = Customer::where('id', $request->user()->customer_id)->first();
    Mail::to('contacto@sanxavier.com')->send(new NewCustomer($customer));

    Mail::to($request->user()->email)->send(new VerifiedCustomerPending($customer));

    return redirect()->route('customer.index')->with('flash.bannerStyle', 'success')->with('flash.banner', 'Correo Verificado Correctamente. Revisaremos tu información y nos pondremos en contacto en las próximas 24 horas para activar tu cuenta.');
})->middleware(['auth:customer', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user('customer')->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth:customer', 'throttle:6,1'])->name('verification.send');




Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
Route::get('shop', [CustomerController::class, 'shop'])->name('customer.shop');
Route::get('/producto/{productSlug}', [CustomerController::class, 'showProduct'])->name('show-product');


Route::middleware([RedirectIfAuthenticated::class . ':customer'])->group(function () {
    Route::get('/cliente/login', [LoginController::class, 'login'])->name('customer.login');
    Route::post('/cliente/login', [LoginController::class, 'loginPost'])->name('customer.login.post');

    Route::get('/cliente/register', [RegisterController::class, 'register'])->name('customer.register');
    Route::post('/cliente/register', [RegisterController::class, 'registerPost'])->name('customer.register.post');

    Route::get('/cliente/register-phone', [RegisterController::class, 'registerPhone'])->name('customer.register.phone');
    Route::post('/cliente/register-finish', [RegisterController::class, 'registerFinish'])->name('customer.register.finish');
});


Route::middleware([RedirectIfNotAuthenticated::class . ':customer'])->group(function () {
    Route::post('cliente/logout', [AuthManager::class, 'logout'])->name('customer.logout');
    Route::get('cliente/direcciones', [CustomerController::class, 'addresses'])->name('customer.addresses');
    Route::get('cliente/realizar-pedido', [CustomerController::class, 'checkout'])->middleware([RedirectIfCartIsEmpty::class, CheckVerified::class . ':customer'])->name('customer.checkout');
    Route::get('cliente/muchas-gracias', [CustomerController::class, 'thankyou'])->name('customer.thankyou');
    Route::get('cliente/no-verificado', [CustomerController::class, 'notVerified'])->name('customer.not.verified');
    Route::get('/carrito', [CustomerController::class, 'cart'])->middleware([CheckVerified::class . ':customer'])->name('cart');
});
