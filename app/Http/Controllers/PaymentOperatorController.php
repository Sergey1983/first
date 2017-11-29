<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\paymentRequest;

use App\Payments_to_operator;

use App\Tour;

class PaymentOperatorController extends Controller
{
    
	public function create(Tour $tour)

	{
		
		return view('payment.operator.edit', compact('tour'));

	}



	public function store(paymentRequest $request, Tour $tour)

	{


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
