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

use App\Document;


class FunctionsController extends Controller

{
    public function check_passport(check_docRequest $request)

    {


        $doc_number = $request->doc_number;

        $doc_type = $request->doc_type;

        $tourist_nubmer = is_null($request->tourist_nubmer) ? 0 : $request->tourist_nubmer;


        $document = Document::where([['doc_type', '=', $doc_type], ['doc_number', '=', $doc_number]])->first();




    	if(!$document) {
            
           return 'not found';

        }

        $not_needed_keys = array_flip(['id', 'created_at', 'updated_at', 'tourist_id', 'user_id']);


        $document_array = array_diff_key($document->toArray(), $not_needed_keys);

        $tourist_array = array_diff_key($document->tourist->toArray(), $not_needed_keys);

        

        if($document_array['seria'] != 0) {

            $document_array['doc_seria'] =  substr($document_array['doc_number'], 0, $document_array['seria']);

            $document_array['doc_number'] = substr($document_array['doc_number'], $document_array['seria']);

          }

        unset($document_array['seria']);

        $array_to_return = [];


        foreach ($tourist_array as $key => $value) {

            $array_to_return[$key.'['.$tourist_nubmer.']'] = $value;

        }



        
        foreach ($document_array as $key => $value) {
            
            $array_to_return[$key.'['.$tourist_nubmer.'][0]'] = $value;

        }


        return $array_to_return;
            	
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

            // $tour_doc1 = $tour->tour_tourist->document1->toArray();

            // $tour_doc2 = $tour->tour_tourist->document2->toArray();



            // We'll put all tour params in this array:
            $tour_tourists_docs_array = $tour_array;

            $doc_needed_fields = array_flip(['doc_type', 'doc_number', 'doc_seria', 'date_issue', 'date_expire']);


            $i = 0;

            foreach ($tour_tourists as $tourist) {



                if($tourist['pivot']['is_buyer'] == 1  ) {

                    $tour_tourists_docs_array['is_buyer'] = $i;
                    $tour_tourists_docs_array['is_tourist'] = $tourist['pivot']['is_tourist'];

                }
                

                $docs[0] = Document::find($tourist['pivot']['doc0'])->toArray();

                if(isset($tourist['pivot']['doc1'])) {

                $docs[1] = Document::find($tourist['pivot']['doc1'])->toArray();

                $tour_tourists_docs_array['second_doc'][] = $i; 


                }


                foreach ($docs as $key => $values) {


                      if($values['seria'] != 0) {

                        $values['doc_seria'] =  substr($values['doc_number'], 0, $values['seria']);

                        $values['doc_number'] = substr($values['doc_number'], $values['seria']);

                      }


                    $values = array_intersect_key($values, $doc_needed_fields);

                    $key = '['.$i.']'.'['.$key.']';

                    foreach ($values as $name => $value) {

                      $tour_tourists_docs_array[$name.$key] = $value;

                    }

                    
                }

                unset($tourist['pivot']);
                unset($tourist['id']);
                unset($tourist['created_at']);
                unset($tourist['updated_at']);


                foreach ($tourist as $key => $value) {

                    $key = $key.'['.$i.']';
                    $tour_tourists_docs_array[$key] = $value;

                }


            $tour_tourists_docs_array['number_of_tourists'] = $i+1;



                $i+=1;
            }


            // $j = 1;

            // foreach ($tour_tourists as $tourist) {

            //     $pivot = $tourist['pivot']; //Pivot = tour-tourists relations & is_buyer & is_torist
                
            //     $tourist = $tourist;
                
            //     unset($tourist['pivot']);
                
            //     $tourist = array_merge($tourist, $pivot);

            //     $removeKeys = array('id', 'nameEng', 'lastNameEng', 'created_at', 'updated_at', 'tour_id', 'tourist_id');

            //         foreach($removeKeys as $key) {
            //             unset($tourist[$key]);
            //         }

            //     $tour_tourist_array[$j]=$tourist;

            //     $j++;

            //  }
       

             return $tour_tourists_docs_array;
    }


    public function airport_load (Request $request) 

    {

        $country = Country::where('country', $request->country)->first();

        return $country->airports_array();

    }

    


}