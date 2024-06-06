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
    })->name('reports.sales.index');

    //Sales report routes
    Route::get('admin/reportes/pedidos', function () {
        return view('pages.admin.reports.orders.index');
    })->name('reports.orders.index');
});