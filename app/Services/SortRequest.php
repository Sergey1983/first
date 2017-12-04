<?php

namespace App\Services;

use Illuminate\Http\Request;


/**
*
*/
class SortRequest extends RequestVariables
{
	

    static function return_sorted(Request $request)
    
    {


    RequestVariables::init();


        $request_array = request()->all();

// dump($request_array);

        $number_of_tourists = count(request()->name);

        $request_sorted = [];

        $request_sorted['tour'] = array_intersect_key($request_array, parent::$keys_tour);

            $request_sorted['tour']['tour_type'] = $request->tour_type;
            $request_sorted['tour']['price'] = $request->price?: $request->price_rub;
            $request_sorted['tour']['first_payment'] = $request->first_payment ?: null;
            $request_sorted['tour']['bank'] = $request->bank ?: null;
            $request_sorted['tour']['noexit_insurance_people'] = $request->noexit_insurance_people ?: null;
            $request_sorted['tour']['visa_people'] = $request->visa_people ?: null;
            $request_sorted['tour']['visa_add_people'] = $request->visa_add_people ?: 0;
            $request_sorted['tour']['date_hotel'] = $request->date_hotel ?: 0;
            $request_sorted['tour']['add_rooms'] = $request->add_rooms ?: 0;
            $request_sorted['tour']['change_food_type'] = $request->change_food_type ?: 0;
            $request_sorted['tour']['is_credit'] = $request->is_credit ?: 0;
            $request_sorted['tour']['first_payment'] = $request->first_payment ?: null;
            $request_sorted['tour']['bank'] = $request->bank ?: null;
            $request_sorted['tour']['noexit_insurance_add_people'] = $request->noexit_insurance_add_people ?: 0;
            $request_sorted['tour']['change_sightseeing'] = $request->change_sightseeing ?: 0;
            $request_sorted['tour']['add_source'] = $request->add_source ?: 0;
            $request_sorted['tour']['extra_info'] = $request->extra_info ?: null;



        $tourists_array =  array_intersect_key($request_array, parent::$keys_tourist);


        if($request_array['allchecked']=='true') {

            $request_sorted['allchecked'] = true;

        }

// dump('request sorted', $request_sorted);
// die();

// dd(isset($request_array['check_info_tourists']) AND isset($request_array['check_info_docs']));

        if(isset($request_array['check_info_tourists']) AND isset($request_array['check_info_docs']) ) {

                $check_info_tourists = $request_array['check_info_tourists'];

                $check_info_docs = $request_array['check_info_docs'];


            foreach ($check_info_tourists as $tourist_id => $value) {
                
                if(isset($value['id']) AND  $value['id']== 'new') {

                    $check_info_tourists[$tourist_id] = ["exists"=>false];

                }

            }

        }



        foreach ($tourists_array as $property=>$values) {

                for ($i=0; $i<$number_of_tourists; $i++) {

                    $request_sorted['tourists'][$i][$property] = $values[$i];

                    }

        }
        

        if(isset($check_info_tourists)) {

                foreach ($check_info_tourists as $tourist_id => $values) {

                    foreach ($values as $key => $value) {

                        if($key == "exists" OR $key == "to_be_updated") {

                            $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                        }

                        $request_sorted['tourists'][$tourist_id]['check_info'][$key] = $value;

                    }

                    foreach ($check_info_docs[$tourist_id] as $doc_id => $values) {

                        foreach ($values as $property => $value) {

                        if($property == "exists" OR $property == "to_be_updated") {

                            $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                        }
                            
                            $request_sorted['documents'][$tourist_id][$doc_id]['check_info'][$property] = $value;


                        }
                        
                    }

            }

        } 



        $documents_array = array_intersect_key($request_array, parent::$keys_document);


        foreach ($documents_array['doc_number'] as $tourist_id => $doc_ids) {

            foreach ($doc_ids as $doc_id => $doc_number_value) {

                    if (isset($documents_array['doc_seria'][$tourist_id][$doc_id])) {

                        $seria = $documents_array['doc_seria'][$tourist_id][$doc_id];

                        $new_doc_number = $seria . $doc_number_value;

                        $documents_array['doc_number'][$tourist_id][$doc_id] = $new_doc_number;

                        $documents_array['seria'][$tourist_id][$doc_id] = strlen($seria);
                    
                    } else {

                        $documents_array['seria'][$tourist_id][$doc_id] = 0;

                    }

            }

        }

        unset($documents_array['doc_seria']);


        foreach ($documents_array as $property => $tourist_ids) {
            
                foreach ($tourist_ids as $tourist_id => $doc_ids) {

                    foreach ($doc_ids as $doc_id => $value) {

                         // $request_sorted['tourists'][$tourist_id]['documents'][$doc_number][$property] = $value;
                         $request_sorted['documents'][$tourist_id][$doc_id][$property] = $value;


                    }


                }

        }


        $request_sorted['buyer'] = array_intersect_key($request_array, parent::$keys_buyer);

        return $request_sorted;

    }
	
}