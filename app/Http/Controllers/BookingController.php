<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tour;

use App\previous_tour;

use App\Services\PreviousVersions;

use Validator;



class BookingController extends Controller

{


	public function bookingEdit(Tour $tour)
	{
		
		// $tour = Tour::find($id);

		return view('Booking.booking_edit', compact('tour'));

	}
    
	public function bookingUpdate(Tour $tour, Request $request)

	{

		$messages = ['operator_part_pay.before_or_equal' => 'Дата частичной оплаты должна быть раньше или равна дате полной оплаты!'];


		$validator = Validator::make($request->all(), [

			'operator_part_pay' => 'before_or_equal:operator_full_pay'

		], $messages)->validate();


		// $this->validate($request, [

		// 	'operator_part_pay' => 'before_or_equal:operator_full_pay'

		// ]);		




		$request = $request->toArray();

		// $tour = Tour::find($id);
		
		$createVersion = true;

		// if(is_null($tour->status)) {

		// 	$request['status'] = 'Бронирование';

		// 	previous_tour::where('tour_id', $tour->id)->first()->update(['status'=> 'Бронирование']);

		// 	$createVersion = false;

		// }

		$tour->update($request);

		if($createVersion) { PreviousVersions::createVersion($tour); }

		return redirect()->route('tour.show', ['tour' => $tour]);

	}

}
