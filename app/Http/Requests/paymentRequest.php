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

        $tour = request()->tour;

        $rules = [];

        $pos = strpos(request()->url(), 'pay_tourist');


        if($pos !== false) {

            $payments = $tour->payments_from_tourists;
            $price = $tour->price;
            $price_rub = $tour->price_rub;

        } else {

            $payments = $tour->payments_to_operator;
            $price = $tour->operator_price;
            $price_rub = $tour->operator_price_rub;

        }


        $checksum = $payments->sum('pay') + request()->pay;
        $checksum_rub = $payments->sum('pay_rub') + request()->pay_rub;


        if ($checksum > $price) {

            $rules['pay'] = 'toomuch';
        }

        if($checksum_rub > $price_rub) {

            $rules['pay_rub'] = 'toomuch';

        }


        return $rules;
    }

    public function messages() {


        $messages = ['toomuch' =>'Слишком большое значение'];

        return $messages;

    }
}
