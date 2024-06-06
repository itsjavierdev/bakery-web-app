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
    })->name('orders.index');
    Route::get('admin/pedidos/create', Orders\Create::class)->name('orders.create');
    Route::get('admin/pedidos/{order}/edit', Orders\Update::class)->name('orders.edit');
    Route::get('admin/pedidos/{order}', Orders\Detail::class)->name('orders.show');

    //Sales routes
    Route::get('admin/ventas', function () {
        return view('pages.admin.transactions.sales.index');
    })->name('sales.index');
    Route::get('admin/ventas/create', Sales\Create::class)->name('sales.create');
    Route::get('admin/ventas/{sale}/edit', Sales\Update::class)->name('sales.edit');
    Route::get('admin/ventas/{sale}', Sales\Detail::class)->name('sales.show');

    //Payments routes
    Route::get('admin/deudas', function () {
        return view('pages.admin.transactions.payments.index');
    })->name('debts.all');

    Route::get('admin/deudas/{sale}/add', Payments\Add::class)->name('debts.add');
    Route::get('admin/deudas/{sale}/edit', Payments\Update::class)->name('debts.edit');
    Route::get('admin/deudas/{sale}', Payments\Detail::class)->name('debts.show');


    Route::get('admin/pagos', function () {
        return view('pages.admin.transactions.payments.all-payments');
    })->name('payments.index');

    Route::get('admin/pagos/{sale}/edit', Payments\Update::class)->name('payments.edit');
    Route::get('admin/pagos/{sale}', Payments\Detail::class)->name('payments.show');
});