<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Request;

use App\Payments_to_operator;

use App\Tour;


class paymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()


    {


        $rules = [

            'pay' => 'regex: /^-?\d+(\.\d+)?$/',
            'pay_rub' => 'regex: /^-?\d+(\.\d+)?$/',

        ];




        return $rules;
    }

    public function messages() {


        $messages = [

            'pay.regex' => 'Сумма к оплате: только цифры и (одна) точка. Правильно: "1000" и "1000.25". Неправильно: "1000,25"',
            'pay_rub.regex' => 'Сумма к оплате: только цифры и (одна) точка. Правильно: "1000" и "1000.25". Неправильно: "1000,25"',
        ];

        return $messages;

    }
}
