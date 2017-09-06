<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\paymentRequest;

use App\Payments_to_operator;

use App\Tour;

class PaymentOperatorController extends Controller
{
    
	public function create($id)

	{
		
		$tour = Tour::find($id);

		return view('payment.operator.edit', compact('tour'));

	}

	public function create_with_deleted($id)
	{

		$tour = Tour::find($id);

		session()->flash('with_deleted', 'true');

		return redirect()->route('payment_operator.create', ['id' => $tour->id]);

	}



	public function store(paymentRequest $request, $id)

	{

		$tour = Tour::find($id);

        $user = auth()->user();

		$request = $request->toArray();


		Payments_to_operator::create(array_merge(['tour_id'=>$tour->id, 'user_id'=>$user->id], $request));


		return redirect()->route('payment_operator.create', ['id' => $tour->id]);


	}



	public function delete($id, $payment_id)
		
	{
		$tour = Tour::find($id);

        $user = auth()->user();
		
		Payments_to_operator::destroy($payment_id);

		Payments_to_operator::withTrashed()->where('id', $payment_id)->update(['deleted_by' => $user->id]);

		return redirect()->route('payment_operator.create', ['id' => $tour->id]);

	}

}
