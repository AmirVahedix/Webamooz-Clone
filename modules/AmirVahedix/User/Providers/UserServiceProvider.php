<?php

namespace AmirVahedix\User\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider {
    public function register () {
        Route::middleware('web')
            ->group(__DIR__.'/../Routes/user_routes.php');

        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
    }

    public function boot () {

    }
}
