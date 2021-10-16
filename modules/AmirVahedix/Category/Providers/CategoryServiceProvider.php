<?php


namespace AmirVahedix\Category\Providers;


use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Category\Models\Category;
use AmirVahedix\Category\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::middleware(['web', 'auth', 'verified'])
            ->prefix('categories')
            ->group(__DIR__.'/../Routes/CategoryRoutes.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'Category');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        Gate::policy(Category::class, CategoryPolicy::class);
        Gate::before(function($user) {
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });
    }

    public function boot()
    {
        config()->set('sidebar.items.categories', [
            'icon' => 'i-categories',
            'title' => 'دسته‌بندی ها',
            'url' => 'admin.categories.index',
            'permission' => Permission::PERMISSION_MANAGE_CATEGORIES
        ]);
    }
}
