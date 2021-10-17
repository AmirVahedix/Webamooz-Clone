<?php


namespace AmirVahedix\Course\Rules;


use AmirVahedix\Course\Repositories\SeasonRepo;
use AmirVahedix\User\Repositories\UserRepo;
use Illuminate\Contracts\Validation\Rule;

class IsValidSeason implements Rule
{
    public function passes($attribute, $value)
    {
        return resolve(SeasonRepo::class)
            ->findByIdAndCourseId($value, request()->route('course'));
    }

    public function message()
    {
        return "سرفصل انتخاب شده نامعتبر است.";
    }
}
