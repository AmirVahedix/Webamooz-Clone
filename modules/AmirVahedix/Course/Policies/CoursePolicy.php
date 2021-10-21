<?php

namespace AmirVahedix\Course\Policies;

use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Models\Lesson;
use AmirVahedix\Course\Repositories\CourseRepo;
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
        return $user->hasAnyPermission([Permission::PERMISSION_MANAGE_COURSES, Permission::PERMISSION_MANAGE_OWN_COURSES]);
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

    public function details(User $user, Course $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) return true;

        return ($course->teacher_id == $user->id) && $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);
    }

    public function download(User $user, Course $course)
    {
//        if ($user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN)) return true;
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) return true;
        if ($user->id == $course->teacher_id) return true;
        if ($course->hasStudent($user)) return true;
        return false;
    }
}
