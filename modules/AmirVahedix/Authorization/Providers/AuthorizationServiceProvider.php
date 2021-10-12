<?php


namespace AmirVahedix\Authorization\Providers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AuthorizationServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::middleware(['web', 'auth', 'verified'])
            ->prefix('authorization')
            ->group(__DIR__.'/../Routes/AuthorizationRoutes.php');

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'Authorization');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');
    }

    public function boot()
    {
        config()->set('sidebar.items.authorization', [
            'icon' => 'i-authorization',
            'title' => 'نقش‌های کاربری',
            'url' => 'admin.authorization.index'
        ]);
    }
}
