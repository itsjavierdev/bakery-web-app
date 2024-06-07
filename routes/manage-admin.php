<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ManagementAdmin\Roles;
use App\Livewire\Admin\ManagementAdmin\Staff;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //Role routes
    Route::get('admin/roles', function () {
        return view('pages.admin.management-admin.roles.index');
    })->middleware('can:roles.read')->name('roles.index');
    Route::get('admin/roles/create', Roles\Create::class)->middleware('can:roles.create')->name('roles.create');
    Route::get('admin/roles/{role}/edit', Roles\Update::class)->middleware('can:roles.update')->name('roles.edit');
    Route::get('admin/roles/{role}', Roles\Detail::class)->middleware('can:roles.read')->name('roles.show');

    //Staff routes
    Route::get('admin/personal', function () {
        return view('pages.admin.management-admin.staff.index');
    })->middleware('can:staff.read')->name('staff.index');
    Route::get('admin/personal/create', Staff\Create::class)->middleware('can:staff.create')->name('staff.create');
    Route::get('admin/personal/{staff}/edit', Staff\Update::class)->middleware('can:staff.update')->name('staff.edit');
    Route::get('admin/personal/{staff}', Staff\Detail::class)->middleware('can:staff.read')->name('staff.show');

});