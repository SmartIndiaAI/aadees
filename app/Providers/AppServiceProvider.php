<?php

namespace App\Providers;

use App\Models\Vendor;
use App\Models\Order;
use App\Observers\VendorObserver;
use App\Observers\OrderObserver;
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
        \Illuminate\Support\Facades\View::composer('*', \App\Http\View\Composers\ThemeComposer::class);

        // Register Observers
        Vendor::observe(VendorObserver::class);
        Order::observe(OrderObserver::class);
    }
}
