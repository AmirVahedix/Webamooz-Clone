<?php


namespace AmirVahedix\Ticket\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreReplyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'body' => ['required'],
            'attachment' => ['nullable', 'file', 'max:10240'],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'عنوان تیکت',
            'body' => 'متن تیکت',
            'attachment' => 'پیوست',
        ];
    }
}
