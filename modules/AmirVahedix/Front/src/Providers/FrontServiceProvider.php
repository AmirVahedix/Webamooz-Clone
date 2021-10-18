<?php

namespace AmirVahedix\Front\Providers;

use Illuminate\Support\ServiceProvider;

class FrontServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/FrontRoutes.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'Front');
    }

    public function boot()
    {

    }
}
