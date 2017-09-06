<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tour;

class BookingController extends Controller

{

	public function bookingEdit($id)
	{
		
		$tour = Tour::find($id);

		return view('booking.booking_edit', compact('tour'));

	}
    
	public function bookingUpdate($id, Request $request)

	{

		// dd($request->toArray());

		$request = $request->toArray();

		$tour = Tour::find($id);

		$tour->update($request);

		return redirect()->route('tour.show', ['id' => $id]);

	}

}
