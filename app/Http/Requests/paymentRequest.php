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

            'pay' => 'regex: /^\d+(\.\d+)?$/',
            'pay_rub' => 'regex: /^\d+(\.\d+)?$/',

        ];

//         $pos = strpos(request()->url(), 'pay_tourist');

// //checks if it's payments to operator or tourist

//         if($pos !== false) {

//             $payments = $tour->payments_from_tourists;
//             $price = $tour->price;
//             $price_rub = $tour->price_rub;

//         } else {

//             $payments = $tour->payments_to_operator;
//             $price = $tour->operator_price;
//             $price_rub = $tour->operator_price_rub;

//         }




//         $checksum_rub = $payments->sum('pay_rub') + request()->pay_rub;

//         if($checksum_rub > $price_rub) {

//             $rules['pay_rub'] = 'toomuch';

//         }

//         if(isset(request()->pay)) {

//             $checksum = $payments->sum('pay') + request()->pay;

//             if ($checksum > $price) {

//                 $rules['pay'] = 'toomuchсur';
//             }



//         }





        return $rules;
    }

    public function messages() {


        $messages = [

            // 'toomuch' =>'Слишком большое значение в рублях!',
            // 'toomuchсur' => 'Слишком большое значение в валюте!',
            'pay.regex' => 'Сумма к оплате: только цифры и (одна) точка. Правильно: "1000" и "1000.25". Неправильно: "1000,25"',
            'pay_rub.regex' => 'Сумма к оплате: только цифры и (одна) точка. Правильно: "1000" и "1000.25". Неправильно: "1000,25"',
        ];

        return $messages;

    }
}
