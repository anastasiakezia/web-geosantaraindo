<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Service;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share services ke semua view agar tidak perlu kirim manual di tiap controller
        View::share('services', Service::with('images')->orderBy('created_at', 'desc')->get());

        // Bagikan semua service ke semua view
        View::share('allServices', Service::orderBy('name')->get());

        Paginator::useBootstrapFive();
    }
}
