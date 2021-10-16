<?php


namespace AmirVahedix\Course\Http\Requests\Season;


use Illuminate\Foundation\Http\FormRequest;

class UpdateSeasonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'min:3'],
            'number' => ['required', 'integer'],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'عنوان سرفصل',
            'number' => 'شماره سرفصل',
        ];
    }
}
