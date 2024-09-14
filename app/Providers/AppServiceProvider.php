<?php

namespace App\Providers;

// use DebugBar\DebugBar;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Barryvdh\Debugbar\Facades\Debugbar;
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
        Route::bind('slug', function ($slug) {
            return Category::findBySlug($slug) ?? abort(404);
        });

        // if ($this->app->environment('local')) {
        //     Debugbar::enable();
        // }
    }
}
