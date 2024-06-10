<?php


use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Reports\Vouchers;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //Sales report routes
    Route::get('admin/reportes/ventas', function () {
        return view('pages.admin.reports.sales.index');
    })->middleware('can:sales_report.generate')->name('reports.sales.index');

    //Sales report routes
    Route::get('admin/reportes/pedidos', function () {
        return view('pages.admin.reports.orders.index');
    })->middleware('can:orders_report.generate')->name('reports.orders.index');

    //Vouchers routes
    Route::get('admin/comprobantes', function () {
        return view('pages.admin.reports.vouchers.index');
    })->middleware('can:vouchers.generate')->name('vouchers.index');
    Route::get('admin/comprobante-venta/{sale}', Vouchers\SalesDetail::class)->middleware('can:vouchers.generate')->name('vouchers.show');
});