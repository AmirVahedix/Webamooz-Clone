<?php

namespace AmirVahedix\Comment\Rules;

use AmirVahedix\Comment\Repositories\CommentRepo;
use Illuminate\Contracts\Validation\Rule;

class IsCommentApproved implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $comment = (new CommentRepo())->findApproved($value);
        return !is_null($comment);
    }

    public function message()
    {
        return 'کامنت نامعتبر';
    }
}
