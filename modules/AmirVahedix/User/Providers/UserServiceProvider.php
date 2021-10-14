<?php

namespace AmirVahedix\User\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider {
    public function register () {
        Route::middleware('web')
            ->group(__DIR__.'/../Routes/user_routes.php');

        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'User');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');
    }

    public function boot () {
        config()->set('sidebar.items.users', [
            'icon' => 'i-users',
            'title' => 'کاربران',
            'url' => 'admin.users.index'
        ]);
    }
}
