<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\paymentRequest;

use App\Payments_to_operator;

use App\Tour;

use Validator;

class PaymentOperatorController extends Controller
{
    
	public function create(Tour $tour)

	{
		
		return view('Payment.Operator.edit', compact('tour'));

	}



	public function store(paymentRequest $request, Tour $tour)

	{

		$rules = [


			'pay' => 'numeric|max:99999999',
			'pay_rub' => 'numeric|max:99999999'


		];


        $payments = $tour->payments_to_operator;
        $price = $tour->operator_price;
        $price_rub = $tour->operator_price_rub;

        $checksum_rub = $payments->sum('pay_rub') + request()->pay_rub;

        if($checksum_rub > $price_rub) {

            $rules['pay_rub'] = 'toomuch';

        }

        if(isset(request()->pay)) {

            $checksum = $payments->sum('pay') + request()->pay;

            if ($checksum > $price) {

                $rules['pay'] = 'toomuchсur';
            }

        }


        $messages = [

            'toomuch' =>'Слишком большое значение в рублях!',
            'toomuchсur' => 'Слишком большое значение в валюте!',
            'pay.max' => 'Сумма: Не больше чем 99999999 (если стоимость больше - бери деньги и беги в Казахстан!)',
            'pay_rub.max' => 'Сумма: Не больше чем 99999999 (если стоимость больше - бери деньги и беги в Казахстан!)'	
        ];


		$validator = Validator::make($request->all(), $rules, $messages)->validate();


        $user = auth()->user();

		$request = $request->toArray();


		Payments_to_operator::create(array_merge(['tour_id'=>$tour->id, 'user_id'=>$user->id], $request));


		// return redirect()->route('payment_operator.create', ['id' => $tour->id]);

		return back();

	}


	public function create_with_deleted(Tour $tour)
	{

		session()->flash('with_deleted', 'true');

		return back();
		// return redirect()->route('payment_operator.create', ['id' => $tour->id]);

	}


	public function delete(Tour $tour, $payment_id)
		
	{

        $user = auth()->user();
		
		Payments_to_operator::destroy($payment_id);

		Payments_to_operator::withTrashed()->where('id', $payment_id)->update(['deleted_by' => $user->id]);

		// return redirect()->route('payment_operator.create', ['id' => $tour->id]);

		return back();
	}

}
