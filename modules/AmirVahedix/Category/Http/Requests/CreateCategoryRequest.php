<?php


namespace AmirVahedix\Category\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'title' => ['required', 'min:3', 'unique:categories,title'],
            'slug' => ['required', 'min:3', 'unique:categories,slug'],
            'parent_id' => ['nullable', 'exists:categories,id']
        ];
    }
}
