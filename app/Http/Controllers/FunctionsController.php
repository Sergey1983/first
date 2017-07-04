<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\check_docRequest;

use App\Http\Requests\findPassengersRequest;

use App\Tourist;

use App\Tour2;

class FunctionsController extends Controller

{
    public function check_passport(check_docRequest $request)

    {

    	$r = $request->doc_fullnumber;

    	$tourist = Tourist::where('doc_fullnumber', '=', $r)->get();

    	return $tourist;
    	
     }

     public function load_tours()

     {
     	
     	$tours = Tour2::exclude(['created_at', 'updated_at'])->get();

     	return $tours;
     }

        public function find_passengers (findPassengersRequest $request) 

    {
    
        $tour_id = $request->tour;

        $tour = Tour2::find($tour_id);
        
        $tourists = $tour->tourists;

        return $tourists;

    }


        public function edit_tour_prepare_data (Request $request) 
    {


            $id = $request->input(0);

            
            $tour = Tour2::find($id);

            // Tour info Array (without tourists info):
            $tour_array = collect($tour)->only(['сity_from', 'hotel'])->toArray();

            $tour_tourists = $tour->tourists->toArray();

            // We'll put all tour params in this array:
                $tourist_array = array(0 => $tour_array);


            $j = 1;

            foreach ($tour_tourists as $tourist) {

                $pivot = $tourist['pivot']; //Pivot = tour-tourists relations & is_buyer & is_torist
                
                $tourist = $tourist;
                
                unset($tourist['pivot']);
                
                $tourist = array_merge($tourist, $pivot);

                $removeKeys = array('id', 'nameEng', 'lastNameEng', 'created_at', 'updated_at', 'tour2_id', 'tourist_id');

                    foreach($removeKeys as $key) {
                        unset($tourist[$key]);
                    }

                $tourist_array[$j]=$tourist;

                $j++;

             }
       
               

             return $tourist_array;
    }


    
}
