<?php


namespace AmirVahedix\Discount\Http\Requests;


use AmirVahedix\Discount\Rules\ValidJalaliDate;
use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountRequest extends FormRequest
{
    public function autorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => ['nullable', 'string', 'max:50', 'unique:discounts,code'],
            'percent' => ['required', 'numeric', 'min:1', 'max:100'],
            'limit' => ['nullable', 'numeric', 'min:1', 'max:1000000000'],
            'expires_at' => ['nullable', new ValidJalaliDate],
            'courses' => ['nullable', 'array']
        ];
    }

    public function attributes()
    {
        return [
            "code" => "کد تخفیف",
            "percent" => "درصد تخفیف",
            "limit" => "محدودیت استفاده",
            "expires_at" => "تاریخ انقضا",
            "courses" => "دوره ها",
        ];
    }
}
