<?php

namespace AmirVahedix\Dashboard\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::middleware(['web', 'auth', 'verified'])
            ->group(__DIR__.'/../Routes/dashboard_routes.php');

        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'Dashboard');
    }

    public function boot()
    {

    }
}
