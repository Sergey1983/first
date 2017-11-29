<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\paymentRequest;

use App\Payments_from_tourist;

use App\Tour;

class PaymentTouristController extends Controller
{
    
	public function create(Tour $tour)

	{
		
		// $tour = Tour::find($id);

		return view('payment.tourist.edit', compact('tour'));

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

		// $tour = Tour::find($id);

        $user = auth()->user();

		$request = $request->toArray();

		$request['pay'] = isset($request['pay']) ? $request['pay'] : $request['pay_rub'];

		Payments_from_tourist::create(array_merge(['tour_id'=>$tour->id, 'user_id'=>$user->id], $request));


		return redirect()->route('payment_tourist.create', ['id' => $tour->id]);


	}



	public function delete(Tour $tour, $payment_id)
	
	{
		$tour = Tour::find($id);

        $user = auth()->user();
		
		Payments_from_tourist::destroy($payment_id);

		Payments_from_tourist::withTrashed()->where('id', $payment_id)->update(['deleted_by' => $user->id]);


		return redirect()->route('payment_tourist.create', ['id' => $tour->id]);

	}

}
