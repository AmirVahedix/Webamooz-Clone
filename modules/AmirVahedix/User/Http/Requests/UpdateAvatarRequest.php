<?php


namespace AmirVahedix\User\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UpdateAvatarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => ['required', 'file', 'image']
        ];
    }
}
