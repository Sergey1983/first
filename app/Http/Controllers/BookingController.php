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

		$messages = [

			'operator_part_pay.before_or_equal' => 'Дата частичной оплаты должна быть раньше или равна дате полной оплаты!',
			'operator_price.regex' => 'Сумма к оплате: только цифры (и одна запятая)',
			'operator_price_rub.regex' => 'Сумма к оплате: только цифры (и одна запятая)',
	];


		$validator = Validator::make($request->all(), [

			'operator_part_pay' => 'before_or_equal:operator_full_pay', 
			'operator_price' => 'regex: /^\d+(,\d+)?$/',
			'operator_price_rub' => 'regex: /^\d+(,\d+)?$/'

		], $messages)->validate();


		// $this->validate($request, [

		// 	'operator_part_pay' => 'before_or_equal:operator_full_pay'

		// ]);		



		$request = $request->toArray();

		$fmt = numfmt_create( 'ru_RU', \NumberFormatter::DECIMAL );

		if(array_key_exists('operator_price', $request)) {

			$request['operator_price'] = numfmt_parse($fmt, $request['operator_price']);
		}


		if(array_key_exists('operator_price_rub', $request)) {

			$request['operator_price_rub'] = numfmt_parse($fmt, $request['operator_price']);
		}

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
