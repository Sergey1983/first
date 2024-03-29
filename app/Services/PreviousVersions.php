<?php

namespace App\Services;

use App\previous_tour;

use App\previous_tourist;

use App\previous_tour_tourist;

use App\previous_document;

use App\Tour;

use App\Tourist;

use App\Document;

use App\Tour_tourist;



class PreviousVersions extends RequestVariables {



        // public $keys_tourist = ['name', 'lastName', 'birth_date', 'doc_fullnumber'];
        // public $keys_tourist_eng = ['nameEng', 'lastNameEng'];
        // public $keys_tour = ['city_from', 'hotel'];
        // public $keys_user = ['user_id']; 
        // public $keys_buyer = ['is_buyer', 'is_tourist'];
        // public $keys_timestamps = ['created_at', 'updated_at'];
        // public $keys_hidden = ['cannot_change_old_tourists', 'tour_exists', 'is_update'];


        public static function createVersion ($tour, $another_user_id = null) {

        RequestVariables::init();

// dump('$tourists1', $tour->tourists);


            $version_last_saved = previous_tour_tourist::where('tour_id', $tour->id)->orderBy('this_version', 'desc')->first();


            if(empty($version_last_saved)) {

                $version_last_saved = 1;

                $last_version_creation_time = date("Y-m-d", strtotime($tour->tour_tourist[0]->created_at));


            } else {

                $version_last_saved = $version_last_saved->this_version +1;

                $last_version_creation_time = $tour->tour_tourist[0]->updated_at->toDateTimeString();

            }


            // $user_created_version_id = is_null($another_user_id) ? Tour_tourist::where('tour_id', $tour->id)->first()->user_id : $another_user_id;
            $user_created_version_id = is_null($another_user_id) ? Tour_tourist::where('tour_id', $tour->id)->first()->user_id : $another_user_id;


            $tour_array = array_intersect_key($tour->toArray(), array_merge(parent::$keys_tour, parent::$keys_user));


            //find last version if exists
            $tour_last_saved = previous_tour::where('tour_id', $tour->id)->orderBy('version', 'desc')->first();


            if(empty($tour_last_saved) ) {

                $tour_last_saved = previous_tour::create(array_merge($tour_array, ['version'=>1, 'tour_id' => $tour->id]));

            } else {

                $version_new = $tour_last_saved->version+1;

                $tour_last_saved = previous_tour::firstOrCreate(array_merge($tour_array, ['tour_id'=>$tour->id]),  ['version'=> $version_new]);

            };



            $tourists = $tour->tourists;

    // dump('$tourists2', $tourists);

            $tourists_array = $tourists->toArray();

            foreach ($tourists_array as $key => $a_tourist_array) {
                
                $tourists_array[$key] = array_intersect_key($a_tourist_array, parent::$keys_tourist);
            }



            for ($i=0; $i < count($tourists); $i++) { 


                $tourist_last_saved = previous_tourist::where('tourist_id', $tourists[$i]->id)->orderBy('version', 'desc')->first();

                if(empty($tourist_last_saved) ) {

                     $tourist_last_saved = previous_tourist::create(array_merge($tourists_array[$i], ['version'=>1, 'tourist_id' => $tourists[$i]->id]));


                } else {


                    $version_new = $tourist_last_saved->version+1;

                    $tourist_last_saved = previous_tourist::firstOrCreate(array_merge($tourists_array[$i], ['tourist_id'=>$tourists[$i]->id]), ['version'=>$version_new]);

                };


                $count_docs = !is_null($tourists[$i]->pivot->doc1) ? 2 : 1;

                $doc0_last_saved_version = null;

                $doc1_last_saved_version = null;

                for ($j=0; $j<$count_docs; $j++){

                    $doc_id = ($j == 0) ? $tourists[$i]->pivot->doc0 : $tourists[$i]->pivot->doc1;

                    $doc_last_saved = previous_document::where('doc_id', $doc_id)->orderBy('version', 'desc')->first();

                    $keys = parent::$keys_document;

                        unset($keys['doc_seria']);

                        $keys = array_merge($keys, array_flip(['seria', 'tourist_id', 'user_id']));


                    $document = array_intersect_key(Document::find($doc_id)->toArray(), $keys);


                    if(empty($doc_last_saved) ) {

                        // dd($document);

                        // // dd(array_merge($document, ['version'=>1, 'doc_id' => $doc_id]));

                    // dd(array_merge($document, ['version'=>1, 'doc_id' => $doc_id]));

                         $doc_last_saved = previous_document::create(array_merge($document, ['version'=>1, 'doc_id' => $doc_id]));


                    } else {


                        $version_new = $doc_last_saved->version+1;

                        $doc_last_saved = previous_document::firstOrCreate( array_merge($document, ['doc_id' => $doc_id]),  
                            ['version'=>$version_new]);

                    }

                    if($j == 0) { 

                        $doc0_last_saved_version = $doc_last_saved->version; 

                    } else { 

                        $doc1_last_saved_version = $doc_last_saved->version; 

                    }

                }
     


                previous_tour_tourist::create(['tour_id'=>$tour->id, 'tour_version' => $tour_last_saved->version, 
                                                'tourist_id'=>$tourists[$i]->id, 'tourist_version'=>$tourist_last_saved->version, 
                                                'doc0' => $tourists[$i]->pivot->doc0, 'doc0_version' => $doc0_last_saved_version, 'doc1' => $tourists[$i]->pivot->doc1, 'doc1_version' => $doc1_last_saved_version, 
                                                'is_buyer'=> $tourists[$i]->pivot->is_buyer, 'is_tourist'=> $tourists[$i]->pivot->is_tourist, 'version_created'=>$last_version_creation_time, 'this_version' => $version_last_saved, 'user_id'=> $user_created_version_id]);


            }



    }


    public static function create_version_extra($updated_tourists_ids, $updated_docs_ids, $no_need_to_save_version_tour_id, $user_id) {

        // Here we create versions of tours which are not updated directly, but which tourists and/or documents were updated in other tours

            $tour_ids = array();

            foreach ($updated_tourists_ids as $tourist_id) {
               
                $tourist = Tourist::find($tourist_id);

                $tourist->tours->pluck('id')->each(function($item, $key) use (&$tour_ids) {



                    if (!in_array($item, $tour_ids)) {
                        
                        $tour_ids[] = $item;    

                    }



                });

            }

            foreach ($updated_docs_ids as $doc_id) {

                $doc = Tour_tourist::where('doc0', $doc_id)->orWhere('doc1', $doc_id)->get()->pluck('tour_id')->each(function($item, $key) use (&$tour_ids) {

                    
                    if (!in_array($item, $tour_ids)) {
                        
                        $tour_ids[] = $item;    

                
                    }

                });

            }

            // Deleting id of tour which was updated when we passed variables to this fuction (we have already created PrevVersion for it)
            $tour_ids = array_diff($tour_ids, array($no_need_to_save_version_tour_id));

            foreach ($tour_ids as $id) {
                
                $tour = Tour::find($id);

                self::createVersion($tour, $user_id);
            }




    }





}