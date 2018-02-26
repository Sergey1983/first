<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\paymentRequest;

use App\Payments_from_tourist;

use App\Tour;

use Validator;

class PaymentTouristController extends Controller
{
    
	public function create(Tour $tour)

	{
		
		// $tour = Tour::find($id);

		return view('Payment.Tourist.edit', compact('tour'));

	}

	public function create_with_deleted(Tour $tour)
	{

		// $tour = Tour::find($id);

		session()->flash('with_deleted', 'true');

		return redirect()->route('payment_tourist.create', ['id' => $tour->id]);

		// view('payment.tourist.edit', compact('tour'));

	}



	public function store(paymentRequest $request, Tour $tour)

	{

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

		Payments_from_tourist::create(array_merge(['tour_id'=>$tour->id, 'user_id'=>$user->id], $request));


		return redirect()->route('payment_tourist.create', ['id' => $tour->id]);


	}



	public function delete(Tour $tour, $payment_id)
	
	{

        $user = auth()->user();
		
		Payments_from_tourist::destroy($payment_id);

		Payments_from_tourist::withTrashed()->where('id', $payment_id)->update(['deleted_by' => $user->id]);


		return redirect()->route('payment_tourist.create', ['id' => $tour->id]);

	}


	public function list()
	
	{
		
		$tourist_payments = Payments_from_tourist::orderBy('created_at', 'desc')->paginate(30);


		return view('Payment.Tourist.list', ['tourist_payments' => $tourist_payments]);

	}
}
