<?php


namespace AmirVahedix\Authorization\Http\Requests;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('roles', 'name')
                    ->ignore(request()->route()->parameter('role')->id)
            ],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['exists:permissions,id']
        ];
    }
}
