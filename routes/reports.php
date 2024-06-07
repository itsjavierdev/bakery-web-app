<?php


use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //Sales report routes
    Route::get('admin/reportes/ventas', function () {
        return view('pages.admin.reports.sales.index');
    })->middleware('can:sales_report.trigger')->name('reports.sales.index');

    //Sales report routes
    Route::get('admin/reportes/pedidos', function () {
        return view('pages.admin.reports.orders.index');
    })->middleware('can:orders_report.trigger')->name('reports.orders.index');
});