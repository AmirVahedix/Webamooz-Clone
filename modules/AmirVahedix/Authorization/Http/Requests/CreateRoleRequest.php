<?php


namespace AmirVahedix\Authorization\Http\Requests;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'unique:roles,name'],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['exists:permissions,id']
        ];
    }
}
