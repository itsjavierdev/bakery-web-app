<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ManagementAdmin\Roles;
use App\Livewire\Admin\ManagementAdmin\Staff;
use App\Livewire\Admin\Parameters\Categories;
use App\Livewire\Admin\Parameters\Products;
use App\Livewire\Admin\Parameters\DeliveryTimes;
use App\Livewire\Admin\Parameters\CompanyContact;
use App\Livewire\Admin\ManagementCustomers\Customers;
use App\Livewire\Admin\Transactions\Orders;
use App\Livewire\Admin\Transactions\Sales;
use App\Livewire\Admin\Transactions\Payments;

include __DIR__ . '/livewire.php';

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('admin', function () {
        return view('pages.admin.dashboard');
    })->name('/');
    //Role routes
    Route::get('admin/roles', function () {
        return view('pages.admin.management-admin.roles.index');
    })->name('roles.index');
    Route::get('admin/roles/create', Roles\Create::class)->name('roles.create');
    Route::get('admin/roles/{role}/edit', Roles\Update::class)->name('roles.edit');
    Route::get('admin/roles/{role}', Roles\Detail::class)->name('roles.show');

    //Staff routes
    Route::get('admin/personal', function () {
        return view('pages.admin.management-admin.staff.index');
    })->name('staff.index');
    Route::get('admin/personal/create', Staff\Create::class)->name('staff.create');
    Route::get('admin/personal/{staff}/edit', Staff\Update::class)->name('staff.edit');
    Route::get('admin/personal/{staff}', Staff\Detail::class)->name('staff.show');

    //Categories routes
    Route::get('admin/categorias', function () {
        return view('pages.admin.parameters.categories.index');
    })->name('categories.index');
    Route::get('admin/categorias/create', Categories\Create::class)->name('categories.create');
    Route::get('admin/categorias/{category}/edit', Categories\Update::class)->name('categories.edit');
    Route::get('admin/categorias/{category}', Categories\Detail::class)->name('categories.show');

    //Categories routes
    Route::get('admin/productos', function () {
        return view('pages.admin.parameters.products.index');
    })->name('products.index');
    Route::get('admin/productos/create', Products\Create::class)->name('products.create');
    Route::get('admin/productos/{product}/edit', Products\Update::class)->name('products.edit');
    Route::get('admin/productos/{product}', Products\Detail::class)->name('products.show');

    //Delivery Times routes
    Route::get('admin/horarios', function () {
        return view('pages.admin.parameters.delivery-times.index');
    })->name('deliverytimes.index');
    Route::get('admin/horarios/create', DeliveryTimes\Create::class)->name('deliverytimes.create');
    Route::get('admin/horarios/{deliverytime}/edit', DeliveryTimes\Update::class)->name('deliverytimes.edit');
    Route::get('admin/horarios/{deliverytime}', DeliveryTimes\Detail::class)->name('deliverytimes.show');

    //Customer routes
    Route::get('admin/clientes', function () {
        return view('pages.admin.management-customers.customers.index');
    })->name('customers.index');
    Route::get('admin/clientes/create', Customers\Create::class)->name('customers.create');
    Route::get('admin/clientes/{customer}/edit', Customers\Update::class)->name('customers.edit');
    Route::get('admin/clientes/{customer}', Customers\Detail::class)->name('customers.show');

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
    Route::get('admin/pagos', function () {
        return view('pages.admin.transactions.payments.index');
    })->name('payments.index');
    Route::get('admin/pagos/{sale}/add', Payments\Add::class)->name('payments.add');
    Route::get('admin/pagos/{sale}/edit', Payments\Update::class)->name('payments.edit');
    Route::get('admin/pagos/{sale}', Payments\Detail::class)->name('payments.show');

    //Sales routes
    Route::get('admin/informacion', function () {
        return view('pages.admin.parameters.company-contact.index');
    })->name('company-contact.index');
    Route::get('admin/información/edit', CompanyContact\Update::class)->name('company-contact.edit');
});
