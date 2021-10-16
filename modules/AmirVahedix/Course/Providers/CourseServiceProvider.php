<?php


namespace AmirVahedix\Course\Providers;


use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Models\Season;
use AmirVahedix\Course\Policies\CoursePolicy;
use AmirVahedix\Course\Policies\SeasonPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CourseServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::middleware(['web', 'auth', 'verified'])
            ->prefix('dashboard')
            ->group(__DIR__.'/../Routes/CourseRoutes.php');

        Route::middleware(['web', 'auth', 'verified'])
            ->prefix('dashboard/seasons')
            ->group(__DIR__.'/../Routes/SeasonRoutes.php');

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'Course');
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');

        Gate::policy(Course::class, CoursePolicy::class);
        Gate::policy(Season::class, SeasonPolicy::class);

        Gate::before(function($user) {
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });
    }

    public function boot()
    {
        config()->set('sidebar.items.courses', [
            'icon' => 'i-courses',
            'title' => 'دوره ها',
            'url' => 'admin.courses.index',
            'permission' => [Permission::PERMISSION_MANAGE_COURSES, Permission::PERMISSION_MANAGE_OWN_COURSES]
        ]);
    }
}
