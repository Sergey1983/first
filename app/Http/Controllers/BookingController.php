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


		$rules = [

			'operator_part_pay' => 'before_or_equal:operator_full_pay', 
			'operator_price' => 'regex: /^\d+(\.\d+)?$/',
			'operator_price_rub' => 'regex: /^\d+(\.\d+)?$/',

		];

		$messages = [

			'operator_part_pay.before_or_equal' => 'Дата частичной оплаты должна быть раньше или равна дате полной оплаты!',
			'operator_price.regex' => 'Сумма к оплате: только цифры и (одна) точка. Правильно: "1000" и "1000.25". Неправильно: "1000,25"',
			'operator_price_rub.regex' => 'Сумма к оплате: только цифры и (одна) точка. Правильно: "1000" и "1000.25". Неправильно: "1000,25"',

		];


		$validator = Validator::make($request->all(), $rules, $messages)->validate();

		$request = $request->toArray();



		// $fmt = numfmt_create( 'ru_RU', \NumberFormatter::DECIMAL );

		// if(array_key_exists('operator_price', $request)) {

		// 	$request['operator_price'] = numfmt_parse($fmt, $request['operator_price']);
		// }


		// if(array_key_exists('operator_price_rub', $request)) {

		// 	$request['operator_price_rub'] = numfmt_parse($fmt, $request['operator_price_rub']);
		// }


		unset($request['_token']);
		
		$createVersion = true;

		Tour::where('id', '=', $tour->id)->update($request);

		if($createVersion) { PreviousVersions::createVersion($tour); }

		return redirect()->route('tour.show', ['tour' => $tour]);

	}

}
