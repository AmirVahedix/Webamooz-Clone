<?php


namespace AmirVahedix\Category\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [

            'title' => [
                'required', 'min:3',
                Rule::unique('categories', 'title')
                    ->ignore(request()->route()->category->id)
            ],
            'slug' => [
                'required', 'min:3',
                Rule::unique('categories', 'title')
                    ->ignore(request()->route()->category->id)
            ],
            'parent_id' => ['nullable', 'exists:categories,id']
        ];
    }
}
