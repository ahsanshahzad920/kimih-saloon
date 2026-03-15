<?php

namespace App\Providers;

use App\Models\Sale;
use Illuminate\Pagination\Paginator;
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
        // Sale::observe(\App\Observers\SaleObserver::class);
        Paginator::useBootstrapFour();
        Paginator::useBootstrapFive();
    }
}
