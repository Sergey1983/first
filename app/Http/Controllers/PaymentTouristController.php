<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\paymentRequest;

use App\Payments_from_tourist;

use App\Tour;

use Validator;

class PaymentTouristController extends Controller
{
    
	public function create(Tour $tour, Request $request)

	{
		
		return view('Payment.Tourist.edit', compact('tour', 'request'));

	}

	public function create_with_deleted(Tour $tour)
	{


		session()->flash('with_deleted', 'true');

		return redirect()->route('payment_tourist.create', ['id' => $tour->id]);



	}



	public function store(paymentRequest $request, Tour $tour)

	{

		$route = 'payment_tourist.create';
		$parameters = ['id' => $tour->id];

		//If payments is added instantly after CREATING a tour;

		if(isset($request->create) && $request->create == true) {

			$route = 'contract.show';
			$parameters= array_merge($parameters, ['doc_type' => 'contract']);

		} 


		$rules = [];

        $payments = $tour->payments_from_tourists;
        $price = $tour->price;
        $price_rub = $tour->price_rub;


       $checksum_rub = $payments->sum('pay_rub') + request()->pay_rub;

		if($tour->currency == 'RUB') {

	        if($checksum_rub > $price_rub) {

	            $rules['pay_rub'] = 'toomuch';

	        }

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
        ];


		$validator = Validator::make($request->all(), $rules, $messages)->validate();



        $user = auth()->user();



		$request = $request->toArray();

		$request['pay'] = isset($request['pay']) ? $request['pay'] : $request['pay_rub'];

		if($request['pay_method_id'] == 3) {

			$tour->is_credit = 1;

			$tour->save();
		}




		unset($request['create']);

		Payments_from_tourist::create(array_merge(['tour_id'=>$tour->id, 'user_id'=>$user->id], $request));


		return redirect()->route($route, $parameters);


	}



	public function delete(Tour $tour, $payment_id)
	
	{

        $user = auth()->user();
		
		Payments_from_tourist::destroy($payment_id);

		Payments_from_tourist::withTrashed()->where('id', $payment_id)->update(['deleted_by' => $user->id]);


		return redirect()->route('payment_tourist.create', ['id' => $tour->id]);

	}


	public function list(Request $request)
	
	{

		if(isset($request->date_from) && isset($request->date_to)) {

            $date_from = \Carbon\Carbon::createFromFormat('Y-m-d', $request->date_from)->startOfDay(); 

            $date_to = \Carbon\Carbon::createFromFormat('Y-m-d', $request->date_to)->endOfDay();


            $dates = 

            [
                ['created_at', '>=', $date_from],
                ['created_at', '<=', $date_to]
            ];

        } else {

			$dates = [];

        }

		
		$tourist_payments = Payments_from_tourist::where($dates)->orderBy('created_at', 'desc')->paginate(30);


		return view('Payment.Tourist.list', ['tourist_payments' => $tourist_payments]);

	}
}
