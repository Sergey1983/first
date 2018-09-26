<?php

namespace App\Http\Controllers;

use App\Services\SortNullAlwaysLast;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;

use Illuminate\Http\Request;

use App\Http\Requests\check_docRequest;

use App\Http\Requests\findPassengersRequest;

use App\Tourist;

use App\Tour;

use App\Airport;

use App\Country;

use App\Document;

use App\Operator;

use App\Sample;


class FunctionsController extends Controller

{
    public function check_passport(check_docRequest $request)

    {

        $doc_number = $request->doc_number;

        $doc_type = $request->doc_type;

        $number = $request->tourist_number;

        $tourist_number = $request->tourist_number;

        $document0 = Document::where([['doc_type', '=', $doc_type], ['doc_number', '=', $doc_number]])->first();

    	if(!$document0) {
            
           return 'not found';

        }

        $tourist = $document0->tourist;

// dump('document0', $document0);

        $tour_tourist = $tourist->tour_tourist->sortByDesc('created_at');

// dump('$tour_tourist', $tour_tourist);

        $document1 = null;

        $tour_tourist->each(function ($item, $key) use ($document0, &$document1){

            for($i = 0; $i <2; $i++) {

                $doc = $item->{"document$i"}; 

                // dump($i, $doc);

                if($doc !== null) {

                    // dump('doc_id', $doc->id, 'document0->id', $document0->id, $doc->id != $document0->id, $doc->type, $document0->type, $doc->type != $document0->type );

                    if($doc->id != $document0->id && $doc->doc_type != $document0->doc_type) {

                        $document1 = $doc;

                        // dump('doc', $doc, 'document1', $document1);

                        return false;
                    }
                }
            }

        });


// dd('document1', $document1, 'document0', $document0);

        $not_needed_keys = array_flip(['id', 'created_at', 'updated_at', 'tourist_id', 'user_id']);

        $document0['relations'] = [];

        $tourist['relations'] = [];


        $number_of_docs = is_null($document1) ? 1 : 2;



        for($i = 0; $i < $number_of_docs; $i ++) {

            // dump("document$i", ${"document$i"});

            $documents_array[$i] = array_diff_key(${"document$i"}->toArray(), $not_needed_keys);

           

            if($documents_array[$i]['seria'] != 0) {

                $documents_array[$i]['doc_seria'] =  substr($documents_array[$i]['doc_number'], 0, $documents_array[$i]['seria']);

                $documents_array[$i]['doc_number'] = substr($documents_array[$i]['doc_number'], $documents_array[$i]['seria']);

              }

            unset($documents_array[$i]['seria']);

        }


        $array_to_return = [];

        
        $tourist_array = array_diff_key($tourist->toArray(), $not_needed_keys);

        foreach ($tourist_array as $key => $value) {

            $array_to_return[$key.'['.$tourist_number.']'] = $value;

        }



        foreach ($documents_array as $key => $document_array) {
                
            foreach ($document_array as $doc_key => $value) {
                
                $array_to_return[$doc_key.'['.$tourist_number.']['.$key.']'] = $value;

            }

        }


        return array_merge($array_to_return, ['number' => $tourist_number]);
            	
    }


    public function sort($request) {

        if(isset($request->sort_name)) {

            $sort_column = $request->sort_name;

            $sort_value = $request->sort_value;

        } else {

            $sort_column = 'created_at';

            $sort_value = 'desc';

        }

        return ['column' => $sort_column, 'order' => $sort_value];
    }



    public function filters($request, $user, &$hide_cancelled = null) {

        $actuality = [];
        $status = [];
        $created = [];
        $depart = [];
        $ids = [];
        $country = [];
        $operator = [];
        $hotel = [];
        $product = [];
        $manager = [];
        $branch = [];
        $user_id = [];
        $city_from = [];
        $tour_type = [];




        if($request->actuality == "Да") {

            $actuality =  [['date_depart', '>=', date("Y-m-d H:i:s")]];

            $actuality_yes = true;


        } else if ($request->actuality == "Нет") {

            $actuality =[['date_depart', '<=', date("Y-m-d H:i:s") ]];


        } 

        // else if ($request->actuality == "Любые") {

        //         $actuality = [];


        // }


       if($request->status == "Нет") {

            $hide_cancelled = false;

        }




        if(!is_null($request->created_from) OR !is_null($request->created_to)) {

    
            if(!is_null($request->created_from)) {


                $created_from = \Carbon\Carbon::createFromFormat('Y-m-d', $request->created_from)->startOfDay(); 

                $created[] = ['created_at', '>=', $created_from];

            }

            if(!is_null($request->created_to)) {

                $created_to = \Carbon\Carbon::createFromFormat('Y-m-d', $request->created_to)->endOfDay();

                $created[] = ['created_at', '<=', $created_to];

            }


        } 


        if(!is_null($request->depart_from) OR !is_null($request->depart_to)) {


            if(!is_null($request->depart_from)) {

                $depart_from = $request->depart_from;

                $depart[] = ['date_depart', '>=', $depart_from];

            }

            if(!is_null($request->depart_to)) {

                $depart_to = $request->depart_to;

                $depart[] = ['date_depart', '<=', $depart_to];

            }


        } 



        if(!is_null($request->ids_from) OR !is_null($request->ids_to)) {


            if(!is_null($request->ids_from)) {

                $ids[] = ['id', '>=', $request->ids_from]; 

            }

            if(!is_null($request->ids_to)) {

                $ids[] = ['id', '<=', $request->ids_to];


            }
            

        }


        if(!is_null($request->country)) {

            $country = [['country', $request->country]];

        }



        if(!is_null($request->operator)) {

            $operator = [['operator', $request->operator]];

        } 



        if(!is_null($request->hotel)) {

            $hotel = [['hotel', 'like', '%'.$request->hotel.'%']];

        } 


        if(!is_null($request->product)) {

            $product = [['tour_type', $request->product]];

        } 


        if(!is_null($request->manager)) {

            $manager = [['user_id', $request->manager]];

        } 


        if($user !== 'statistics') {


            if($user->permission !=0) {

                if(!$user->isAdmin()) {

                    $branch = [['branch_id', $user->branch->id]];


                } else {

                    $branch = is_null($request->branch) ? [] : [['branch_id', $request->branch]];

                }


            } else { 

                $user_id = [['user_id', $user->id]];

            }

        } else {

            if(!is_null($request->user_id)) {
            
                $user_id = [['user_id', $request->user_id]];

            }

        }


        if(!is_null($request->city_from)) {

            $city_from = [['city_from', $request->city_from]];
        }

        if(!is_null($request->tour_type)) {

            $tour_type = [['tour_type', $request->tour_type]];
        }

        return array_merge($actuality, $status, $created, $depart, $ids, $country, $operator, $hotel, $product, $manager, $branch, $user_id, $city_from, $tour_type);

    }


    public function commission ($tour) {

        $commission = 0;

        $a = 0;

            if($tour->currency == 'RUB') {

                    $operator_price = $tour->operator_price_rub;
                    $already_paid_to_opeartor = $tour->payments_to_operator_rub_sum();

                } else {

                    $operator_price = $tour->operator_price;
                    $already_paid_to_opeartor = $tour->payments_to_operator_sum();

                }

            if(
                ($tour->payments_from_tourists_rub_sum() != 0) AND ($operator_price == (string)$already_paid_to_opeartor) 
              )

             {

                $commission = round ( ( 1 - $tour->payments_to_operator_rub_sum() / $tour->payments_from_tourists_rub_sum() ) * 100, 2);
        
            } else {

                $comission = "-";

            }

    return $commission;

    }


     public function load_tours(Request $request)

     {
    	

        $user = auth()->user();

        $tourist_search = false;

        $actuality_yes = $request->actuality == "Да" ? true : false;

        $hide_cancelled = true;

        $sort = $this->sort($request);

        $filters = $this->filters($request, $user, $hide_cancelled); 


        if(isset($request->tourist_name) OR isset($request->tourist_lastname)) {

            $tourist_search = true;

            $name = isset($request->tourist_name) ? [ ['name', 'like', '%'.$request->tourist_name.'%'] ] : [];
            $last_name = isset($request->tourist_lastname) ? [ ['lastName', 'like', '%'.$request->tourist_lastname.'%'] ] : [];


            $tourists = Tourist::where(array_merge($name, $last_name))->get(); 


            $tour_tourists_ids_array = [];

            if(!empty($tourists)) {

                foreach ($tourists as $key => $tourist) {
                
                  $tour_tourists_ids_array =  array_merge($tour_tourists_ids_array, $tourist->tours->pluck('id')->toArray());

                }

            }


        } else {

            $tour_tourists_ids_array = [];

        }


        $paginate = $request->paginate;


        // if($user->permission !=0) {


        //     if($user->isAdmin()) {

               
               // Get all models as collection:

               $collection = Tour::when($tourist_search, function($query) use ($tour_tourists_ids_array) {

                    return $query->whereIn('id', $tour_tourists_ids_array);

                    })


                    ->when($hide_cancelled, function($query){

                        return $query->where(function($query) {
                                
                                $query->where('status', '<>', 'Аннулировано')

                                ->orwhereNull('status');

                                });

                    })

                    ->where($filters)

                    ->orderBy($sort['column'], $sort['order'])->get();

        $tours_for_accounting = $collection;


// dd(array_column($collection->toArray(), 'status', 'id'));

        // FOR ACCOUNTING:



        if($user->isAdmin()) {

            $saldo_RUB = 0;
            $saldo_USD = 0;
            $saldo_EUR = 0;

            foreach ($tours_for_accounting as $tour) {

            $payments_to_operator = $tour->currency == 'RUB' ? $tour->payments_to_operator_rub_sum() : $tour->payments_to_operator_sum();


            $tour->pay_date = $payments_to_operator == 0 ? $tour->operator_part_pay : $tour->operator_full_pay;


                if(!is_null($tour->operator_price_rub)) {

                    $currency = self::getCurrency($tour);

                    $operator_price = $tour->currency == 'RUB' ? $tour->operator_price_rub : $tour->operator_price;

                    $debt_agency =  number_format($operator_price - $payments_to_operator, 2, '.', '');

                    $debt_customer = number_format($tour->price - $tour->payments_from_tourists_sum(), 2, '.', '');

                    $saldo = $debt_agency - $debt_customer;

                    $tour->saldo = $saldo.' '.$currency;

                    $tour->debt_agency = $debt_agency.' '.$currency;

                    $tour->debt_customer = $debt_customer.' '.$currency;

                    ${'saldo_'.$tour->currency} += $saldo;


                } else {

                    $tour->saldo = null;

                    $tour->debt_agency = null;

                    $tour->debt_customer = null;


                }



            }


        //Sort by pay_date if it's accounting (pay_date can be both 'operator_full_pay' and 'operator_part_pay' so the sorting when getting tours from DB makes no sense)

            if($sort['column'] == 'operator_full_pay') {

                $sort_method = $sort['order'] == 'asc' ? 'sortBy' : 'sortByDesc';

                $collection = $collection->filter(function($value, $key){ return $value->pay_date !== null; });

                $collection = $collection->{$sort_method}('pay_date');

            }



        }

        // END FOR ACCOUNTING;



//PAGINATION

        //Get current page:

        $current_page = Paginator::resolveCurrentPage();

        // Get items for current page (use values() method to reset the keys):

        $items = $collection->slice(($current_page - 1) * $paginate, $paginate)->values();

        $total = $collection->count();

        $tours = new Paginator($items, $total, $paginate, $current_page, ['path' => Paginator::resolveCurrentPath()]);



//END PAGINATION;


        foreach ($tours as $key => $tour) {
            
            $tour->user_name = $tour->user_created();

            $tour->number_of_tourists = $tour->tourists_only_who_really_go->count();

            $currency = self::getCurrency($tour);



// COMMISION: We put this in code before other money values, because $tour->operator_price_rub later is being added with ruble currency sign.

            $tour->comission = $this->commission($tour);


// COMMISION: end;


            $tour->operator = $tour->operator_model->name;

            $tour->debt_customer = number_format($tour->price - $tour->payments_from_tourists_sum(), 2, '.', '');
            
            $tour->price = number_format($tour->price, 0, '.', ' ').' '.$currency;

            $tour->price_rub = number_format($tour->price_rub, 0, '.', ' ').' &#x20bd';

            $tour->operator_price_rub = number_format($tour->operator_price_rub, 0, '.', ' ').' &#x20bd';

            $tour->operator_price = ($tour->currency == 'RUB') ? $tour->operator_price_rub : number_format($tour->operator_price, 0, '.', ' ').' '.$currency;

            $tour->status = substr($tour->status, 0, 2);


            $from = $tour->city_from == 'Москва' ? 'MOW' : Airport::where('city', $tour->city_from)->first()->code;

            $to = ($tour->airport == 'BKA' OR $tour->airport == 'DME' OR $tour->airport == 'SVO' OR $tour->airport == 'VKO') ? 'MOW' : $tour->airport;

            $back = Airport::where('city', $tour->city_return)->first()->code;


            $tour->product = $from.'-'.$to.'-'.$back;

            $tour->product_tooltip = $tour->city_from.'-'.$tour->country.'-'.$tour->city_return;







            foreach ($tour->tour_tourist as $tourist) {
                
                if($tourist->is_buyer == 1) {

                    $buyer = Tourist::find($tourist->tourist_id);

                    $tour->buyer = $buyer->lastName.' '.substr($buyer->name, 0, 2).'.';

                }


            }


        }






        if($user->isAdmin()) {

            $custom = collect(['tours_saldo_RUB' => $saldo_RUB.' '.'&#x20bd', 'tours_saldo_USD' => $saldo_USD.' '.'&#36', 'tours_saldo_EUR' => $saldo_EUR.' '.'&#8364']);

            $tours = $custom->merge($tours);

        }


// dd($tours);

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

        // $country = Airport::where('country', $request->country)->get();

        $airport = new Airport;

        $country = $airport->airports_array($request->country);

        return $country;

    }

    
    public function get_tourists_and_docs($tour_tourists, $need_buyer=true)

    {

            $doc_needed_fields = array_flip(['doc_type', 'doc_number', 'doc_seria', 'date_issue', 'date_expire', 'who_issued', 'address_pass', 'address_real']);


                    $i = 0;

            foreach ($tour_tourists as $tourist) {



            if($need_buyer)

            {                if($tourist['pivot']['is_buyer'] == 1  ) {

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



    public static function getCurrency($tour) {

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

        return $currency;
    }



}