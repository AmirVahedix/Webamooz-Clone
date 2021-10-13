<?php


namespace AmirVahedix\Course\Http\Requests;


use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Rules\IsTeacher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCourseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required'],
            'slug' => ['required', 'min:3', 'unique:courses,slug'],
            'priority' => ['nullable', 'numeric'],
            'price' => ['required', 'numeric', 'min:0'],
            'percent' => ['required', 'numeric', 'min:0', 'max:100'],
            'teacher_id' => ['required', 'exists:users,id', new IsTeacher()],
            'type' => ['required', Rule::in(Course::types)],
            'status' => ['required', Rule::in(Course::statuses)],
            'category_id' => ['required', 'exists:categories,id'],
            'banner' => ['required', 'file', 'image', 'mimes:jpg,png,jpeg'],
            'description' => ['nullable']
        ];
    }
}