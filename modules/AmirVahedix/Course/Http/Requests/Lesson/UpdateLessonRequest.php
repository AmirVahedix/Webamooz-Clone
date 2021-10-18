<?php


namespace AmirVahedix\Course\Http\Requests\Lesson;


use AmirVahedix\Course\Rules\IsValidSeason;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'min:3'],
            'slug' => ['nullable', 'min:3'],
            'number' => ['required', 'numeric'],
            'duration' => ['nullable', 'numeric'],
            'free' => ['required', 'in:0,1'],
            'season_id' => ['nullable', 'exists:seasons,id', new IsValidSeason()],
            'file' => ['nullable', 'file']
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'عنوان درس',
            'slug' => 'اسلاگ درس',
            'number' => 'شماره درس',
            'duration' => 'مدت زمان درس',
            'free' => 'وضعیت دسترسی',
            'season_id' => 'سرفصل',
            'file' => 'فایل درس'
        ];
    }
}
