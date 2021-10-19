<?php

namespace AmirVahedix\Media\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    public function register() {
        Route::middleware(['web'])
            ->group(__DIR__.'/../Routes/MediaRoutes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__.'/../Configs/media.php', 'media');
    }
}
