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
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/components/atoms');
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/components/molecules');
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/components/organisms');
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/components/templates');
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/components/layouts');
        Blade::anonymousComponentPath(__DIR__ . '/../../resources/views/layouts');
    }
}
