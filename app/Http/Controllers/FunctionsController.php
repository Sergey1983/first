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

        // dump($request->all());


        $doc_number = $request->doc_number;

        $doc_type = $request->doc_type;

        $number = $request->tourist_number;



        // dump($request->tourist_number);
        // dump($number);
        // dump(is_null($request->tourist_number));


        $tourist_number = $request->tourist_number;

        // dump($tourist_number);

        // die();

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

            $array_to_return[$key.'['.$tourist_number.']'] = $value;

        }



        
        foreach ($document_array as $key => $value) {
            
            $array_to_return[$key.'['.$tourist_number.'][0]'] = $value;

        }


        return $array_to_return;
            	
    }




     public function load_tours(Request $request)

     {
     	

        $user = auth()->user();


        // dd($request->all());

        if(isset($request->sort_name)) {

            $sort_column = $request->sort_name;

            $sort_value = $request->sort_value;

        } else {

            $sort_column = 'id';

            $sort_value = 'asc';

        }


        if($request->actuality == "Да") {

            $actuality = [

                ['date_depart', '>=', date("Y-m-d H:i:s")]

                        ];

        } else if ($request->actuality == "Нет") {

            $actuality = [

                ['date_depart', '<=', date("Y-m-d H:i:s") ]

                        ];

        } else if ($request->actuality == "Любые") {

                $actuality = [];

        }



        if(!is_null($request->created_from) OR !is_null($request->created_to)) {


            $created_from =  \Carbon\Carbon::createFromFormat('Y-m-d', $request->created_from);

            $created_to = \Carbon\Carbon::createFromFormat('Y-m-d', $request->created_to);

            $created = 

            [
                ['created_at', '>=', $created_from],
                ['created_at', '<=', $created_to]
            ];

        } else {

            $created = [];


        }


        if(!is_null($request->depart_from) OR !is_null($request->depart_to)) {

            $depart_from = $request->depart_from;

            $depart_to = $request->depart_to;

            $depart = [];

            if(!is_null($request->depart_from)) {

                $depart[] = ['date_depart', '>=', $depart_from];

            }

            if(!is_null($request->depart_to)) {

                $depart[] = ['date_depart', '<=', $depart_to];

            }

            // $depart[] = !is_null($request->depart_from) ? :;

            // $depart[] = !is_null($request->depart_to) ? ['date_depart', '<=', $depart_to] : [];




            // $depart = 

            // [
            //     ['date_depart', '>=', $depart_from],
            //     ['date_depart', '<=', $depart_to]
            // ];

        } else {

            $depart = [];


        }



        if(!is_null($request->country)) {

            $country = [

                ['country', $request->country]

            ];

        } else {

            $country = [];
        }



        if(!is_null($request->operator)) {

            $operator = [

                ['operator', $request->operator]

            ];

        } else {

            $operator = [];
        }



        if(!is_null($request->hotel)) {

            $hotel = [

                ['hotel', 'like', '%'.$request->hotel.'%']

            ];

        } else {

            $hotel = [];
        }

        if(!is_null($request->manager)) {

            $manager = [

                ['user_id', $request->manager]

            ];

        } else {

            $manager = [];
        }




// dd(array_merge($actuality, $created, $depart));


        $paginate = $request->paginate;

        if($user->role_id == 1 OR $user->permission ==1) {

            // $tours = Tour::where($actuality, $created)->paginate(10);

            $tours = Tour::where(array_merge($actuality, $created, $depart, $country, $operator, $hotel, $manager ))

            ->orderBy($sort_column, $sort_value)

            ->paginate($paginate);


        } else {

            $tours = Tour::where(array_merge($actuality, $created, $depart, $country, $operator, $hotel, $manager,  ['user_id', $user->id]))->paginate($paginate);


        }

        // return view('Tours2.tours2', compact('tours'));

        foreach ($tours as $key => $tour) {
            
            $tour->user_name = $tour->user->name;
        }

        return $tours;


     }





        public function find_passengers (findPassengersRequest $request) 

    {
    
        $tour_id = $request->tour;

        $tour = Tour::find($tour_id);
        
        // $tourists = $tour->tourists;

        // // $not_needed_keys = array_flip(['id', 'created_at', 'updated_at']);

        // // $tourist_not_needed_keys = array_merge($not_needed_keys, array_flip(['pivot']));

        // $array_to_return = [];

        $tour_tourists = $tour->tourists->toArray();

        // $tourists_and_docs['number_of_tourists'] = count($tourists_array);


        $tourists_and_docs = $this->get_tourists_and_docs($tour_tourists, false);


        // foreach ($tourists_array as $tourist_id => $tourist_values) {

        //     $tourist_values = array_diff_key($tourist_values, $tourist_not_needed_keys);


        //     foreach ($tourist_values as $name => $value) {

        //         if($name == 'pivot') {

        //                 if($value['doc1'] != 0) {

        //                     $array_to_return['is_buyer'] = $value['is_buyer'];

        //                     $array_to_return['is_tourist'] = $value['is_tourist'];

        //             }

        //         }
                
        //         $array_to_return[$name.'['.$tourist_id.']'] = $value;

        //     }

        // }

        // return $array_to_return;


        return $tourists_and_docs;
    }


        public function edit_tour_prepare_data (Request $request) 
    {



            $id = $request->input(0);

            $tour = Tour::find($id);

            $tour_array = collect($tour)->except(['id', 'user_id', 'updated_at', 'created_at'])->toArray();

            $tour_tourists = $tour->tourists->toArray();


            // We'll put all tour params in this array:
            $tour_tourists_docs_array = $tour_array;

            $tourists_and_docs = $this->get_tourists_and_docs($tour_tourists);


            $tour_tourists_docs_array = array_merge($tour_tourists_docs_array, $tourists_and_docs);

       

            return $tour_tourists_docs_array;
    }


    public function airport_load (Request $request) 

    {

        $country = Country::where('country', $request->country)->first();

        return $country->airports_array();

    }

    
    public function get_tourists_and_docs($tour_tourists, $need_buyer=true)

    {

            $doc_needed_fields = array_flip(['doc_type', 'doc_number', 'doc_seria', 'date_issue', 'date_expire']);


                    $i = 0;

            foreach ($tour_tourists as $tourist) {



            if($need_buyer)

            {
                if($tourist['pivot']['is_buyer'] == 1  ) {

                    $tour_tourists_docs_array['is_buyer'] = $i;
                    $tour_tourists_docs_array['is_tourist'] = $tourist['pivot']['is_tourist'];

                }
            }

            $docs = [];


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

            return $tour_tourists_docs_array;

    }




}