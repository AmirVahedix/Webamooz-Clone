<?php


namespace AmirVahedix\Authorization\Providers;


use AmirVahedix\Authorization\Database\Seeders\AuthorizationTablesSeeder;
use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Authorization\Models\Role;
use AmirVahedix\Authorization\Policies\RolePolicy;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Gate;
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
        DatabaseSeeder::$seeders[] = AuthorizationTablesSeeder::class;

        Gate::policy(Role::class, RolePolicy::class);
        Gate::before(function($user) {
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });
    }

    public function boot()
    {
        config()->set('sidebar.items.authorization', [
            'icon' => 'i-authorization',
            'title' => 'نقش‌های کاربری',
            'url' => 'admin.authorization.index',
            'permission' => Permission::PERMISSION_MANAGE_AUTHORIZATION
        ]);
    }
}
