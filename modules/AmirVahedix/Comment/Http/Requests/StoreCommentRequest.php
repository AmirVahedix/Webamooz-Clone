<?php

namespace AmirVahedix\Comment\Http\Requests;

use AmirVahedix\Comment\Rules\IsCommentable;
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
            "body" => ['required']
        ];
    }
}
