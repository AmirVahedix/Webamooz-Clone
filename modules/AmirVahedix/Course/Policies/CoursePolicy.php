<?php

namespace AmirVahedix\Course\Policies;

use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function manage_courses(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }

    public function create_course(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)
            || $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
    }

    public function edit(User $user, Course $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) return true;

        return ($course->teacher_id == $user->id) && $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
    }

    public function delete(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }

    public function confirm(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }
}
