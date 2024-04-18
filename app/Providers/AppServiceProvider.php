<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/components/admin');
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/components/admin/atoms');
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/components/admin/atoms/table');
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/components/admin/atoms/table/columns');
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/components/admin/atoms/table/columns/orders');
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/components/admin/molecules');
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/components/admin/organisms');
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/components/admin/templates');
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/components/admin/layouts');
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/layouts');
    }
}
