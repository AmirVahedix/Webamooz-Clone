<?php

namespace AmirVahedix\Comment\Http\Requests;

use AmirVahedix\Comment\Rules\IsCommentable;
use AmirVahedix\Comment\Rules\IsCommentApproved;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize ()
    {
        return true;
    }

    public function rules ()
    {
        return [
            "commentable_id" => ['required'],
            "commentable_type" => ['required', new IsCommentable()],
            "parent_id" => ['nullable', new IsCommentApproved()],
            "body" => ['required']
        ];
    }
}
