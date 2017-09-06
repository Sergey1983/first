<?php

namespace App\Http\Controllers;

use App\Services\SortNullAlwaysLast;

use Illuminate\Http\Request;

use App\Http\Requests\check_docRequest;

use App\Http\Requests\findPassengersRequest;

use App\Tourist;

use App\Tour;

use App\Airport;


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

            // Tour info Array (without tourists info):
            $tour_array = collect($tour)->only(['city_from', 'hotel'])->toArray();

            $tour_tourists = $tour->tourists->toArray();

            // We'll put all tour params in this array:
                $tourist_array = array(0 => $tour_array);


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

                $tourist_array[$j]=$tourist;

                $j++;

             }
       
               

             return $tourist_array;
    }


    public function airport_load (Request $request) 

    {

        $country = $request->country;

        $airports = Airport::where('country', $country)->get()->toArray();

        usort($airports, 'App\Services\SortNullAlwaysLast::cmp');


        foreach ($airports as $key => $value) {
            
            $code = $value['code'];

            $name = $value['name'];

            $city = $value['city'];

            $country = $value['country'];

            unset($airports[$key]);

            $airports[$code] = $code.', '.$name.', '.$city.', '.$country;

        }


        return $airports;

    }

    


}