<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Tour;

use App\Http\Controllers\Controller;

class ToursController extends Controller


{

      public function index(Request $request) {


        if ( ($from = $request->get('from')) and ($to = $request->get('to')) ) {
          
        $tours = Tour::where('departure', '>=', $from)
                      ->where('departure', '<=', $to)
                      ->get();

        }

        elseif  ( ($search = $request->get('search'))  ) {

        $tours = Tour::where('name', 'like', '%' .$search. '%')
                      ->orWhere('lastName', 'like', '%' .$search. '%')
                        ->get();

        }

        else  {

         $tours = Tour::all();

        }

      return view('Tours.tours', compact('tours'));
      
      }





   		public function create() {

	    return view('Tours.tourCreate');

		}



   		public function store() {


        Tour::create(request(['name', 'lastName', 'nameEng', 'lastNameEng', 'destination', 'departure']));


	    return redirect()->route('tours_list');

		}

      public function show($id) {

      $tour = Tour::find($id);

      return view('Tours.tour_update', compact('tour'));

    }


      public function update($id) {

        $tour = Tour::find($id);

        //$tour->name=request('name');

        $tour = $tour->update(request(['name', 'lastName', 'nameEng', 'lastNameEng', 'destination', 'departure']));

        ///$tour->save();

      return redirect()->route('tours_list');

    }


}

