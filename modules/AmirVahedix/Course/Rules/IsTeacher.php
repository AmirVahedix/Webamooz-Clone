<?php


namespace AmirVahedix\Course\Rules;


use AmirVahedix\User\Repositories\UserRepo;
use Illuminate\Contracts\Validation\Rule;

class IsTeacher implements Rule
{
    public function passes($attribute, $value)
    {
        $user = resolve(UserRepo::class)->find($value);
        return $user->hasPermissionTo('teach');
    }

    public function message()
    {
        return "کاربر انتخاب شده دسترسی تدریس ندارد.";
    }
}
