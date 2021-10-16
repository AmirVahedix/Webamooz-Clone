<?php


namespace AmirVahedix\Course\Http\Requests\Course;


use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Rules\IsTeacher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required'],
            'slug' => [
                'required',
                'min:3',
                Rule::unique('courses', 'slug')
                    ->ignore(request()->route()->course->id)
            ],
            'priority' => ['nullable', 'numeric'],
            'price' => ['required', 'numeric', 'min:0'],
            'percent' => ['required', 'numeric', 'min:0', 'max:100'],
            'teacher_id' => ['required', 'exists:users,id', new IsTeacher()],
            'type' => ['required', Rule::in(Course::types)],
            'status' => ['required', Rule::in(Course::statuses)],
            'category_id' => ['required', 'exists:categories,id'],
            'banner' => ['nullable', 'file', 'image', 'mimes:jpg,png,jpeg'],
            'description' => ['nullable'],
        ];
    }
}
