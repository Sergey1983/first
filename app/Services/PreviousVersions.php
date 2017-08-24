<?php

namespace App\Services;

use App\previousversionstour2;

use App\previoustourists;

use App\previoustour2_tourist;

use App\Tour2;

use App\Tourist;

use App\Tour2_tourist;



class PreviousVersions {


        public $keys_tourist = ['name', 'lastName', 'birth_date', 'doc_fullnumber'];
        public $keys_tourist_eng = ['nameEng', 'lastNameEng'];
        public $keys_tour = ['сity_from', 'hotel'];
        public $keys_user = ['user_id']; 
        public $keys_buyer = ['is_buyer', 'is_tourist'];
        public $keys_timestamps = ['created_at', 'updated_at'];
        public $keys_hidden = ['cannot_change_old_tourists', 'tour_exists', 'is_update'];


        public function createVersion ($tour) {


            $last_version_creation_time = $tour->tourists[0]->updated_at->toDateTimeString();


            $version_last_saved = previoustour2_tourist::where('tour2_id', $tour->id)->orderBy('this_version', 'desc')->first();

            if(empty($version_last_saved)) {

                $version_last_saved = 1;

            } else {

                $version_last_saved = $version_last_saved->this_version +1;

            }

            $user_created_version_id = Tour2_tourist::where('tour2_id', $tour->id)->first()->user_id;

            // dd($user_created_version_id);

            $tour_array = array_intersect_key($tour->toArray(), array_flip(array_merge($this->keys_tour, $this->keys_user)));


            //find last version if exists
            $tour_last_saved = previousversionstour2::where('tour2_id', $tour->id)->orderBy('version', 'desc')->first();


            if(empty($tour_last_saved) ) {

                $tour_last_saved = previousversionstour2::create(array_merge($tour_array, ['version'=>1, 'tour2_id' => $tour->id]));

            } else {


                $version_new = $tour_last_saved->version+1;

                $tour_last_saved = previousversionstour2::firstOrCreate(array_merge($tour_array, ['tour2_id'=>$tour->id]), ['version'=> $version_new]);

            };



            $tourists = $tour->tourists;

            $tourists_array = $tourists->toArray();

            foreach ($tourists_array as $key => $a_tourist_array) {
                
                $tourists_array[$key] = array_intersect_key($a_tourist_array, array_flip(array_merge($this->keys_tourist, $this->keys_tourist_eng)));
            }



            for ($i=0; $i < count($tourists); $i++) { 


                $tourist_last_saved = previoustourists::where('tourist_id', $tourists[$i]->id)->orderBy('version', 'desc')->first();

                if(empty($tourist_last_saved) ) {

                     $tourist_last_saved = previoustourists::create(array_merge($tourists_array[$i], ['version'=>1, 'tourist_id' => $tourists[$i]->id]));


                } else {


                    $version_new = $tourist_last_saved->version+1;

                    $tourist_last_saved = previoustourists::firstOrCreate(array_merge($tourists_array[$i], ['tourist_id'=>$tourists[$i]->id]), ['version'=>$version_new]);

                };



                previoustour2_tourist::create(['tour2_id'=>$tour->id, 'tour2_version' => $tour_last_saved->version, 
                                                'tourist_id'=>$tourists[$i]->id, 'tourist_version'=>$tourist_last_saved->version, 
                                                'is_buyer'=> $tourists[$i]->pivot->is_buyer, 'is_tourist'=> $tourists[$i]->pivot->is_tourist, 'version_created'=>$last_version_creation_time, 'this_version' => $version_last_saved, 'user_id'=> $user_created_version_id]);


            }



    }


    public function GetIdsOfToursToSavePreviousVersionsOf ($number_of_tourists, $request_array_tourist)
    
    {
    
        $ids_of_tourists_to_be_updated = [];


        for($i=0; $i<$number_of_tourists; $i++) {

            // Create array ['attributeN' => 'valueN',
           //                'attributeN+1' => 'valueN+1']

            foreach ($request_array_tourist as $key => $value) {
                
                    $tourist_to_update[$key] = $value[$i];
  
            }



            if ($tourist_checked = Tourist::where('doc_fullnumber', $tourist_to_update['doc_fullnumber'])->first() ) {

                    if(Tourist::where($tourist_to_update)->count() === 0 ) 
                        // Executed when we have a tourist with doc_fullnubmer from request, but other fields for this tourist are different
                        // I.e. - this tourist is being updated during this sesssion
                    {

                        $ids_of_tourists_to_be_updated[] = $tourist_checked->id;

                    }

                }

        }
        

        //getting models of tourist to be updated
        $non_existing_tourists = Tourist::find($ids_of_tourists_to_be_updated);

        $tours_to_update_ids = [];


        foreach ($non_existing_tourists as $non_existing_tourist) {

             foreach ($non_existing_tourist->tour2s as $key => $value) {
              

                 if(!in_array($value->id, $tours_to_update_ids)) {

                    $tours_to_update_ids[]=$value->id;

                    }

             };

             
        }

    return $tours_to_update_ids;

    }




}