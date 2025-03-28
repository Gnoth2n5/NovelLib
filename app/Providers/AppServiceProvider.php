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
        Blade::component('layouts.admin', 'admin-layout');
        Blade::component('components.admin.sidebar.nav-item', 'admin.sidebar.nav-item');
        Blade::component('components.admin.sidebar.nav-dropdown', 'admin.sidebar.nav-dropdown');
        Blade::component('components.admin.sidebar.logo', 'admin.sidebar.logo');
        Blade::component('components.admin.sidebar.navigation', 'admin.sidebar.navigation');
    }
}