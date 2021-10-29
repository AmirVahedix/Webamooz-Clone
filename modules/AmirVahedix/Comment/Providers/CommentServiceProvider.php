<?php

namespace AmirVahedix\Comment\Providers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::middleware(['web', 'auth'])
            ->group(__DIR__.'/../Routes/CommentRoutes.php');

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    public function boot()
    {

    }
}
