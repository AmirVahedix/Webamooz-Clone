<?php

namespace AmirVahedix\User\Providers;

use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\User\Models\User;
use AmirVahedix\User\Policies\UserPolicy;
use App\Http\Middleware\StoreUserIp;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider {
    public function register () {
        Route::middleware('web')
            ->group(__DIR__.'/../Routes/user_routes.php');

        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'User');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');
//        $this->app['router']->pushMiddlewareToGroup('web', StoreUserIp::class);

        Gate::policy(User::class, UserPolicy::class);
        Gate::before(function($user) {
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });
    }

    public function boot () {
        config()->set('sidebar.items.users', [
            'icon' => 'i-users',
            'title' => 'کاربران',
            'url' => 'admin.users.index'
        ]);
    }
}
