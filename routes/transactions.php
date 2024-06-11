<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Transactions\Orders;
use App\Livewire\Admin\Transactions\Sales;
use App\Livewire\Admin\Transactions\Payments;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //Orders routes
    Route::get('admin/pedidos', function () {
        return view('pages.admin.transactions.orders.index');
    })->middleware('can:orders.read')->name('orders.index');
    Route::get('admin/pedidos/create', Orders\Create::class)->middleware('can:orders.create')->name('orders.create');
    Route::get('admin/pedidos/{order}/edit', Orders\Update::class)->middleware('can:orders.update')->name('orders.edit');
    Route::get('admin/pedidos/{order}', Orders\Detail::class)->middleware('can:orders.read')->name('orders.show');

    //Sales routes
    Route::get('admin/ventas', function () {
        return view('pages.admin.transactions.sales.index');
    })->middleware('can:sales.read')->name('sales.index');
    Route::get('admin/ventas/create', Sales\Create::class)->middleware('can:sales.create')->name('sales.create');
    Route::get('admin/ventas/{sale}/edit', Sales\Update::class)->middleware('can:sales.update')->name('sales.edit');
    Route::get('admin/ventas/{sale}', Sales\Detail::class)->middleware('can:sales.read')->name('sales.show');
    Route::get('admin/ventas-realizada/{sale}', Sales\Success::class)->middleware('can:sales.create')->name('sales.success');

    //Payments routes
    Route::get('admin/deudas', function () {
        return view('pages.admin.transactions.payments.index');
    })->middleware('can:debts.read')->name('debts.all');

    Route::get('admin/deudas/{sale}/add', Payments\Add::class)->middleware('can:debts.add')->name('debts.add');
    Route::get('admin/deudas/{sale}/edit', Payments\Update::class)->middleware('can:debts.update')->name('debts.edit');
    Route::get('admin/deudas/{sale}', Payments\Detail::class)->middleware('can:debts.read')->name('debts.show');
    Route::get('admin/pago-realizado/{payment}', Payments\Success::class)->middleware('can:debts.add')->name('debts.success');

    Route::get('admin/pagos', function () {
        return view('pages.admin.transactions.payments.all-payments');
    })->middleware('can:payments.read')->name('payments.index');

    Route::get('admin/pagos/{sale}/edit', Payments\Update::class)->middleware('can:payments.update')->name('payments.edit');
    Route::get('admin/pagos/{sale}', Payments\Detail::class)->middleware('can:payments.read')->name('payments.show');
});