<?php

namespace App\Providers;

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

    public function boot(): void
    {
        view()->composer('layouts.navigation', function ($view) {
            if (auth()->check() && auth()->user()->role === 'supervisor') {
                $count = \App\Models\Transaction::where('status', 'pending')->count() +
                    \App\Models\StockAdjustment::where('status', 'pending')->count() +
                    \App\Models\Product::where('status', 'pending')->count();
                $view->with('pendingApprovalsCount', $count);
            } else {
                $view->with('pendingApprovalsCount', 0);
            }
        });
    }
}
