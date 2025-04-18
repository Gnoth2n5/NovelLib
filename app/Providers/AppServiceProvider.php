<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Novel;
use Illuminate\Support\ServiceProvider;

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
        Category::observe(\App\Observers\CategoryObserver::class);
        Novel::observe(\App\Observers\NovelObserver::class);
        \App\Models\Chapter::observe(\App\Observers\ChapterObserver::class);
    }
}