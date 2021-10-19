<?php


namespace AmirVahedix\Course\Policies;


use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Models\Lesson;
use AmirVahedix\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {

    }

    public function create(User $user, Course $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES))
            return true;

        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES)
            && $course->teacher->id == $user->id;
    }

    public function edit(User $user, Lesson $lesson)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES))
            return true;

        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES)
            && $lesson->course->teacher->id == $user->id;
    }

    public function delete(User $user, Lesson $lesson)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES))
            return true;

        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES)
            && $lesson->course->teacher->id == $user->id;
    }

    public function deleteMultiple(User $user, Course $course, $lessons)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES))
            return true;

        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES)) {
            if ($course->teacher->id == $user->id) {
                $status = true;
                foreach ($lessons as $lesson_id) {
                    $status = Lesson::findOrFail($lesson_id)->get()->course->id == $course->id;
                }

                return $status;
            }
        }
    }

    public function confirm(User $user)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }
}
