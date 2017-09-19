<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\tourRequest;

use Validator;

use App\Tour;

use App\Tourist;

use App\Document;

use App\Http\Controllers\TouristsController;

use App\Services\Translit;

use App\Services\TouristServices;

use App\Services\PreviousVersions;

use App\Cities;

use App\Test;

use App\previous_tour;

use App\previous_tourist;

use App\previous_tour_tourist;

use App\Events\TouristUpdated;

use App\Listeners\ExtractUpdatedTourist;

use Event;



class Tours2Controller extends Controller

{



    static function return_sorted_request(Request $request)
    
    {

        $keys_tourist = ['name', 'lastName', 'nameEng', 'lastNameEng', 'birth_date', 'citizenship', 'gender', 'phone', 'email', 'doc_fullnumber'];
        $keys_document = ['doc_type', 'doc_seria', 'doc_number', 'date_issue', 'date_expire'];


        // $keys_tourist_eng = ['nameEng', 'lastNameEng'];
        $keys_tour = ['city_from', 'country', 'airport', 'operator', 'nights', 'date_depart', 'date_hotel', 'hotel', 'room', 'add_rooms', 'food_type', 'change_food_type' , 'currency', 'price', 'price_rub', 'is_credit', 'transfer', 'noexit_insurance', 'noexit_insurance_add_people', 'noexit_insurance_people', 'med_insurance', 'visa', 'visa_people', 'visa_add_people', 'change_sightseeing',  'sightseeing', 'extra_info', 'source', 'add_source'];
        $keys_buyer = ['is_buyer', 'is_tourist'];
        $keys_timestamps = ['created_at', 'updated_at'];
        $keys_hidden = ['cannot_change_old_tourists', 'tour_exists', 'is_update'];


        $request_array = request()->all();


        $number_of_tourists = count(request()->name);

        $request_sorted = [];

        $request_sorted['tour'] = array_intersect_key($request_array, array_flip($keys_tour));

            $request_sorted['tour']['price'] = $request->price?: $request->price_rub;
            $request_sorted['tour']['first_payment'] = $request->first_payment ?: null;
            $request_sorted['tour']['bank'] = $request->bank ?: null;
            $request_sorted['tour']['noexit_insurance_people'] = $request->noexit_insurance_people ?: null;
            $request_sorted['tour']['visa_people'] = $request->visa_people ?: null;




        $tourists_array =  array_intersect_key($request_array, array_flip($keys_tourist));

        foreach ($tourists_array as $property=>$values) {

            for ($i=0; $i<$number_of_tourists; $i++) {

                $request_sorted['tourists'][$i][$property] = $values[$i];

            }

        }



        $documents_array = array_intersect_key($request_array, array_flip($keys_document));



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


        $request_sorted['buyer'] = array_intersect_key($request_array, array_flip($keys_buyer));


        return $request_sorted;

    }








    public $keys_tour = ['city_from', 'hotel'];



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {

        $user = auth()->user();


        if($user->role_id == 1 OR $user->permission ==1) {

            $tours = Tour::all();

        } else {

            $tours = Tour::where('user_id', $user->id)->get();
        }

            return view('Tours2.tours2', compact('tours'));

        
    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    
    {

        return view('Tours2.tours2_create');
    
    }








    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)

    public function store(tourRequest $request)
    {

        $request_sorted = self::return_sorted_request($request);

        $user = request()->user();


        $tour = Tour::create(array_merge($request_sorted['tour'], ['user_id' => $user->id]));


        $number_of_tourists = count($request->name);
              

        // $previousVersions = new PreviousVersions;

        // $tours_to_update_ids = $previousVersions->GetIdsOfToursToSavePreviousVersionsOf($number_of_tourists, $request_sorted['tourists']);


        // Saving previous versions of tours where exist tourists from request who are going to be updated (not those who stay the same)

        // foreach ($tours_to_update_ids as $tour_to_update_id) {

        //     $tour_to_save_version = Tour::find($tour_to_update_id);

        //     $previousVersions = new PreviousVersions;

        //     $previousVersions->createVersion($tour_to_save_version);


        // }


        for ($i=0; $i < $number_of_tourists; $i++ ) {



            // If tourist with such passport exists, then just get it from DB.
 
            if ($tourist = Tourist::where('doc_fullnumber', '=', $request['doc_fullnumber'][$i])->first()) {

                $tourist_to_update = $request->only("name.$i", "lastName.$i", "birth_date.$i");

                Tourist::updateTouristWithThisDoc($tourist_to_update, $tourist->id);


            }


            // If tourist doesn't exists, then add it to Database:

            else {

                $tourist = Tourist::create($request_sorted['tourists'][$i]);

                $doc_ids = [];


                foreach ($request_sorted['documents'][$i] as $doc_id => $doc_array) {
                    
                    $document = Document::create(array_merge(['tourist_id'=>$tourist->id, 'user_id'=> $user->id], $doc_array));

                    $doc_ids['doc'.$doc_id] = $document->id;

                    }

                // $tourist = new Tourist;

                // $tourist = $tourist->createFromRequest($request->all(), $i);


            }


            // Check if tourist is a buyer, and if so, if the buyer is a tourist.

            $is_buyer_is_tourist = Tourist::is_buyer_is_tourist($request_sorted['buyer'], $i);


            $tour->tourists()

                ->save($tourist, array_merge($is_buyer_is_tourist, ['user_id' => $user->id], $doc_ids));              

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    
    {
        $tour = Tour::find($id);

        $user = $tour->users;


        $tour_tourists = $tour->tourists;

        $is_versions = 0;

        $versions = previous_tour::where('tour_id', $tour->id)->orderBy('version', 'desc')->first();

        if(count($versions) > 0) {

            $is_versions = 1;
        } 



        return view('Tours2.tours2_show', compact('tour', 'tour_tourists', 'is_versions', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
  
        $tour = Tour::find($id);
        
        return view('Tours2.tours2_edit', compact('tour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(tourRequest $request, $id)

    {
        
        // $keys_tourist = ['name', 'lastName', 'birth_date', 'doc_fullnumber'];
        // $keys_tourist_eng = ['nameEng', 'lastNameEng'];
        // $keys_tour = ['city_from', 'country', 'airport', 'operator', 'nights', 'date_depart', 'date_hotel', 'hotel', 'room', 'add_rooms', 'food_type', 'change_food_type' , 'currency', 'price', 'price_rub', 'is_credit', 'transfer', 'noexit_insurance', 'noexit_insurance_add_people', 'noexit_insurance_people', 'med_insurance', 'visa', 'visa_people', 'visa_add_people', 'change_sightseeing',  'sightseeing', 'extra_info'];
        // $keys_buyer = ['is_buyer', 'is_tourist'];
        // $keys_timestamps = ['created_at', 'updated_at'];
        // $keys_hidden = ['cannot_change_old_tourists', 'tour_exists', 'is_update'];


        // $request_array = request()->all();



        // $request_array_tour = array_intersect_key($request_array, array_flip($keys_tour));
        // $request_array_tourist = array_intersect_key($request_array, array_flip($keys_tourist));
        // $request_array_buyer = array_intersect_key($request_array, array_flip($keys_buyer));

        $request_sorted = self::return_sorted_request($request);


        $user = request()->user();


        $number_of_tourists = count(request()->name);

//RECORDING VERSION OF TOUR-TOURIST

        $tour=Tour::find($id);


        $previousVersions = new PreviousVersions;

        $previousVersions->createVersion($tour);


// UPDATING TOUR-TOURIST

        $tour=Tour::find($id);

        $tour->update($request_sorted['tour']);



        $sync_tourist_array = [];

        $updated = [];


        // app()->singleton('touristsCollector', function ($app) {

        //     $collector = new \stdClass;
        //     $collector->updated = [];

        //     return $collector;

        // });


        $previousVersions = new PreviousVersions;

        $tours_to_update_ids = $previousVersions->GetIdsOfToursToSavePreviousVersionsOf($number_of_tourists, $request_sorted['tourists']);




        // $ids_of_tourists_to_be_updated = [];


        // for($i=0; $i<$number_of_tourists; $i++) {

        //     // Create array ['attributeN' => 'valueN',
        //    //                'attributeN+1' => 'valueN+1']

        //     foreach ($request_array_tourist as $key => $value) {
                
        //             $tourist_to_update[$key] = $value[$i];
  
        //     }



        //     if ($tourist_checked = Tourist::where('doc_fullnumber', $tourist_to_update['doc_fullnumber'])->first() ) {

        //             if(Tourist::where($tourist_to_update)->count() === 0 ) 
        //                 // Executed when we have a tourist with doc_fullnubmer from request, but other fields for this tourist are different
        //                 // I.e. - this tourist is being updated during this sesssion
        //             {

        //                 $ids_of_tourists_to_be_updated[] = $tourist_checked->id;

        //             }

        //         }

        // }

        // //getting models of tourist to be updated
        // $non_existing_tourists = Tourist::find($ids_of_tourists_to_be_updated);

        // $tours_to_update_ids = [];


        // foreach ($non_existing_tourists as $non_existing_tourist) {

        //      foreach ($non_existing_tourist->tours as $key => $value) {
              

        //          if(!in_array($value->id, $tours_to_update_ids)) {

        //             $tours_to_update_ids[]=$value->id;

        //             }

        //      };

             
        // }

        // Erase current tour $id from $tours_to_update, because we have updated it earlier (and we have to update it before, because it may be updated due to $tour-info update, not due to $tourist-info update)

        $tours_to_update_ids = array_diff($tours_to_update_ids, [0=>$id]) ;

        // Saving previous versions of tours where exist tourists from request who are going to be updated (not those who stay the same)

        foreach ($tours_to_update_ids as $tour_to_update_id) {

            $tour_to_save_version = Tour::find($tour_to_update_id);

            $previousVersions = new PreviousVersions;

            $previousVersions->createVersion($tour_to_save_version);


        }






        for($i=0; $i<$number_of_tourists; $i++) {

            // Create array ['attribute' => request_value]

            foreach ($request_sorted['tourists'] as $key => $value) {
                
                    $tourist_to_update[$key] = $value[$i];
  
            }

            $tourist_to_update['nameEng'] = Translit::translit($tourist_to_update['name']);
            $tourist_to_update['lastNameEng'] = Translit::translit($tourist_to_update['lastName']);


            $tourist = Tourist::updateOrCreate(['doc_fullnumber' => $request['doc_fullnumber'][$i]], $tourist_to_update);


            // Check if tourist is a buyer, and if so, if the buyer is a tourist.




            // if ($request['is_buyer'] == $i) { 

            //     $is_buyer = 1;

            //     $is_tourist = $request['is_tourist']; // Buyer can be a tourist or not (1 or 0)

            // } else {

            //     $is_buyer = 0;

            //     $is_tourist = 1; // Tourist (no buyer) is always tourist

            // }

            

            $is_buyer_is_tourist = Tourist::is_buyer_is_tourist($request_sorted['buyer'], $i);
            
            $sync_tourist_array[$tourist->id] = array_merge($is_buyer_is_tourist, ['user_id'=>$user->id]);

            // $sync_tourist_array[$tourist->id] = ['is_buyer' => $is_buyer, 'is_tourist' => $is_tourist];


        };

        // $collector = resolve('touristsCollector');


        // $something = TouristServices::UpdateOtherToursWithTourists($collector->updated);


        $tour->tourists()->sync($sync_tourist_array);


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }






}
