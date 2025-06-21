<?php

namespace App\Providers;

use App\Models\Page\Page;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Gallery\GalleryInterface::class,
            \App\Repositories\Gallery\GalleryRepository::class
    );

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind('path.public', function () {
            return base_path('../public_html');
        });
        //
        // Share data with all views
        View::composer('*', function ($view) {

        });
    }
}
