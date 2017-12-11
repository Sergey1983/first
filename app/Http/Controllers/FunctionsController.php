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
     	
        // return $request->all();

        $user = auth()->user();

        $tourist_search = false;

        if(isset($request->tourist_name) OR isset($request->tourist_lastname)) {

            $tourist_search = true;

            $name = isset($request->tourist_name) ? [ ['name', 'like', '%'.$request->tourist_name.'%'] ] : [];
            $last_name = isset($request->tourist_lastname) ? [ ['lastName', 'like', '%'.$request->tourist_lastname.'%'] ] : [];


            $tourists = Tourist::where(array_merge($name, $last_name))->get(); 

            // dd($tourists->toArray());

            $tour_tourists_ids_array = [];

            if(!empty($tourists)) {

                foreach ($tourists as $key => $tourist) {
                
                  $tour_tourists_ids_array =  array_merge($tour_tourists_ids_array, $tourist->tours->pluck('id')->toArray());

                }

            }


        } else {

            $tour_tourists_ids_array = [];

        }



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




// dump(array_merge($actuality, $created, $depart, $country, $operator, $hotel, $manager ));
// dump($tour_tourists_ids_array);
// die();

        $paginate = $request->paginate;

        if($user->role_id == 1 OR $user->permission ==1) {


            $tours = Tour::when($tourist_search, function($query) use ($tour_tourists_ids_array) {

                return $query->whereIn('id', $tour_tourists_ids_array);

                })

                ->where(array_merge($actuality, $created, $depart, $country, $operator, $hotel, $manager ))

                ->orderBy($sort_column, $sort_value)

                ->paginate($paginate);


        } else {

            $tours = Tour::when($tourist_search, function($query) use ($tour_tourists_ids_array) {

                return $query->whereIn('id', $tour_tourists_ids_array);

                })

                ->where(array_merge($actuality, $created, $depart, $country, $operator, $hotel, $manager,  ['user_id', $user->id]))

                ->orderBy($sort_column, $sort_value)

                ->paginate($paginate);


        }


        // return view('Tours2.tours2', compact('tours'));

        foreach ($tours as $key => $tour) {
            
            $tour->user_name = $tour->user->name;

            $tour->number_of_tourists = $tour->tour_tourist->count();

            switch($tour->currency) {

                case "RUB":

                    $currency = '&#x20bd';

                break;

                case "USD":

                   $currency = '&#36';

                break;

                case "EUR":

                    $currency = '&#8364';

                break;


            }

            $tour->debt = ($tour->price - $tour->payments_from_tourists_sum()).' '.$currency;

            $tour->price = $tour->price.' '.$currency;

            $tour->price_rub = $tour->price_rub.' &#x20bd';

            $tour->operator_price = $tour->operator_price.' '.$currency;

            $tour->operator_price_rub = $tour->operator_price_rub.' &#x20bd';

            $tour->status = substr($tour->status, 0, 2);


            $from = $tour->city_from == 'Москва' ? 'MOW' : Airport::where('city', $tour->city_from)->first()->code;

            $to = ($tour->airport == 'BKA' OR $tour->airport == 'DME' OR $tour->airport == 'SVO' OR $tour->airport == 'VKO') ? 'MOW' : $tour->airport;

            $back = Airport::where('city', $tour->city_return)->first()->code;


            $tour->product = $from.'-'.$to.'-'.$back;

            $tour->product_tooltip = $tour->city_from.'-'.$tour->country.'-'.$tour->city_return;




            if(($tour->payments_from_tourists_rub_sum() != 0) AND ($tour->operator_price_rub == $tour->payments_to_operator_rub_sum()) )

             {

                $tour->comission = round ( ( 1 - $tour->payments_to_operator_rub_sum() / $tour->payments_from_tourists_rub_sum() ) * 100, 2);
        

            } else {

                $tour->comission = "-";

            }


            foreach ($tour->tour_tourist as $tourist) {
                
                if($tourist->is_buyer == 1) {

                    $buyer = Tourist::find($tourist->tourist_id);

                    $tour->buyer = $buyer->lastName.' '.substr($buyer->name, 0, 2).'.';

                }


            }


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

            $doc_needed_fields = array_flip(['doc_type', 'doc_number', 'doc_seria', 'date_issue', 'date_expire', 'who_issued', 'address_pass', 'address_real']);


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