<?php

namespace AmirVahedix\Course\Policies;

use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Models\Season;
use AmirVahedix\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeasonPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function store(User $user, Course $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) return true;

        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES) && ($course->teacher_id == $user->id);
    }

    public function edit(User $user, Season $season)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) return true;

        return ($season->user_id == $user->id) && $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
    }

    public function delete(User $user, Season $season)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) return true;

        return ($season->user_id == $user->id) && $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
    }

    public function confirm(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }
}
