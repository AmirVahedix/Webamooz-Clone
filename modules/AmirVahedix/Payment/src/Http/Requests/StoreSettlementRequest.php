<?php


namespace AmirVahedix\Payment\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreSettlementRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'cart' => ['required', 'numeric', 'digits:16'],
            'amount' => ['required', 'numeric', "max:".auth()->user()->balance]
        ];
    }

    public function attributes()
    {
        return [
            "cart" => "شماره کارت",
            "name" => "نام صاحب حساب",
            "amount" => "مبلغ"
        ];
    }
}
