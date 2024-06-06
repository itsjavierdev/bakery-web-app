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

});