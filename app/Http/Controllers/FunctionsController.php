<?php

namespace App\Http\Controllers;

use App\Services\SortNullAlwaysLast;

use Illuminate\Http\Request;

use App\Http\Requests\check_docRequest;

use App\Http\Requests\findPassengersRequest;

use App\Tourist;

use App\Tour;

use App\Airport;

use App\Country;


class FunctionsController extends Controller

{
    public function check_passport(check_docRequest $request)

    {


        $r = $request->doc_fullnumber;



    	if(!$tourist = Tourist::where('doc_fullnumber', '=', $r)->get()->toArray() ) {

            $a = 'not found';
            return $a;
        }

    	return $tourist;
    	
     }

     public function load_tours()

     {
     	
     	$tours = Tour::exclude(['created_at', 'updated_at'])->get();

     	return $tours;
     }

        public function find_passengers (findPassengersRequest $request) 

    {
    
        $tour_id = $request->tour;

        $tour = Tour::find($tour_id);
        
        $tourists = $tour->tourists;

        return $tourists;

    }


        public function edit_tour_prepare_data (Request $request) 
    {


            $id = $request->input(0);


            $tour = Tour::find($id);

            $tour_array = collect($tour)->except(['id', 'user_id', 'updated_at', 'created_at'])->toArray();

            $tour_tourists = $tour->tourists->toArray();

            // We'll put all tour params in this array:
                $tour_tourist_array = array(0 => $tour_array);


            $j = 1;

            foreach ($tour_tourists as $tourist) {

                $pivot = $tourist['pivot']; //Pivot = tour-tourists relations & is_buyer & is_torist
                
                $tourist = $tourist;
                
                unset($tourist['pivot']);
                
                $tourist = array_merge($tourist, $pivot);

                $removeKeys = array('id', 'nameEng', 'lastNameEng', 'created_at', 'updated_at', 'tour_id', 'tourist_id');

                    foreach($removeKeys as $key) {
                        unset($tourist[$key]);
                    }

                $tour_tourist_array[$j]=$tourist;

                $j++;

             }
       
               

             return $tour_tourist_array;
    }


    public function airport_load (Request $request) 

    {

        $country = Country::where('country', $request->country)->first();

        return $country->airports_array();

    }

    


}