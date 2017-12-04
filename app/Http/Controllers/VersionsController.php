<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tour;

use App\Tourist;

use App\Tour_Tourist;

use App\User;

use App\Airport;

use App\Document;

use App\previous_tour_tourist;

use App\previous_tourist;

use App\previous_document;

use App\previous_tour;

use App\Traits\Excludable;


class VersionsController extends Controller
{

    use Excludable;

    public function show(Tour $tour)

    {
    	

        // $rows_query = previous_tour_tourist::where('tour_id', $tour->id);

        // $version_indexes = $rows_query->get()->pluck('this_version')->unique()->toArray();

        // $version_indexes = array_values($version_indexes);

        // // print_r($version_indexes);

        // foreach ($version_indexes as $key => $version) {

        //     // print_r($version);

        //     $versions[$key]['this_version'] = $version;

        //     $query = previous_tour_tourist::where(['tour_id'=>$tour->id, 'this_version'=> $version]);

        //     $versions[$key]['version_created'] = (clone $query)->select('version_created')->first()->version_created;
        //     $versions[$key]['tour_version'] = (clone $query)->select('tour_version')->first()->tour_version;
        //     $versions[$key]['user'] = (clone $query)->first()->user->name;
        //     $versions[$key]['tour'] = previous_tour::where(['tour_id'=> $id, 'version'=> $versions[$key]['tour_version']])->select('city_from', 'hotel')->first()->toArray();

        //     $versions[$key]['tourists_versions'] = (clone $query)->select('tourist_id', 'tourist_version', 'is_buyer', 'is_tourist')->get()->toArray();



        //     foreach ($versions[$key]['tourists_versions']  as $k => $value) {

        //         $a_query = $value;
        //         $a_query['version'] = $a_query['tourist_version'];
        //         unset($a_query['tourist_version']);
        //         unset($a_query['is_buyer']);
        //         unset($a_query['is_tourist']);

        //         $versions[$key]['tourists'][$k] = previous_tourist::where($a_query)->exclude(['id', 'created_at', 'updated_at'])->first()->toArray();
                
        //         $versions[$key]['tourists'][$k]['is_buyer']= $value['is_buyer']; 
        //         $versions[$key]['tourists'][$k]['is_tourist']= $value['is_tourist'];

        //     };


        // };


        // print_r($versions);

 

        // die();




        // dd($versions);

           // dd($return_array);

    	// return view('Tours2.versions', compact('id', 'return_array'));

        return view('Tours2.versions');

    }

    public function return_versions(Request $request) {

        $id = $request->id;

    // public function return_versions() {

    //     $id = 5;


        $tour = Tour::find($id);

        $versions_collection = $tour->previous_tour_tourist;

        foreach ($versions_collection as $version_instance) {

                    
            $versions_array[$version_instance->this_version][] = array_filter($version_instance->toArray(), function($k) {
                                                                                return $k != 'this_version';
                                                                            }, ARRAY_FILTER_USE_KEY);

            }        




        $i = 1;


        foreach ($versions_array as $this_version => $tourists_and_documents) {


       
            $return_array[$this_version]['tour'] = previous_tour::where([ ['tour_id',$tourists_and_documents[0]['tour_id'] ], ['version', $tourists_and_documents[0]['tour_version']] ])->first()->toArray();


            
            $return_array[$this_version]['tour']['user_name'] = User::find($return_array[$this_version]['tour']['user_id'])->name;


            if($return_array[$this_version]['tour']['airport'] != '-' ) {

                $airport = Airport::where('code', $return_array[$this_version]['tour']['airport'])->first(); 
                
                $return_array[$this_version]['tour']['airport']  = $airport->code.', '.$airport->name.', '.$airport->country;

            }


            $return_array[$this_version]['version_created'] = $tourists_and_documents[0]['version_created'];
            $return_array[$this_version]['user'] = User::find($tourists_and_documents[0]['user_id'])->name;



            foreach ($tourists_and_documents as $key => $tourist_and_documents) {

                $_this = $tourist_and_documents;


                    $return_array[$this_version]['tourists'][$key] = previous_tourist::where([['tourist_id', $_this['tourist_id'] ],['version', $_this['tourist_version']]])->first()->toArray();



                $return_array[$this_version]['tourists'][$key]['docs'][0] = previous_document::where([ ['doc_id', $_this['doc0']], ['version', $_this['doc0_version']] ] )->first()->toArray();

                if(!is_null($_this['doc1'])) {

                    $return_array[$this_version]['tourists'][$key]['docs'][1] = previous_document::where([ ['doc_id', $_this['doc1']], ['version', $_this['doc1_version']] ] )->first()->toArray();

                }

                if($_this['is_buyer']!=0) {

                    $return_array[$this_version]['buyer']['is_buyer'] = $key;

                    $return_array[$this_version]['buyer']['is_tourist'] =  $_this['is_tourist'];

                }

            }

        // dump($return_array);


            if($i>1) {


                $_this = $return_array[$this_version];
                $_previous = $return_array[$this_version-1];



                if(count($_this['tourists']) != count($_previous['tourists'])) {

                    $return_array[$this_version]['number_of_tourists_changed'] = true;

                }



                if ($_this['tour']['version'] != $_previous['tour']['version']) {

                    $_this['differences_tour'] = array_keys(array_diff($_this['tour'],$_previous['tour']));

                    $return_array[$this_version]['differences_tour'] = array_filter($_this['differences_tour'], function($v) {
                                                                                return  !in_array($v, ['version', 'id', 'created_at', 'updated_at']);
                                                                            });

                }


                /// CHECK FOR NEW TOURISTS IN THIS VERSION:

                $_this_tourist_ids = [];
                $_previous_tourist_ids = [];

                foreach ($_this['tourists'] as $key => $tourist) {
                    
                    $_this_tourist_ids[] = $tourist['tourist_id'];
                }

                foreach ($_previous['tourists'] as $key => $tourist) {
                    
                    $_previous_tourist_ids[] = $tourist['tourist_id'];
                }


                // dump($_this_tourist_ids, $_previous_tourist_ids);

                if(!empty($new_tourists = array_keys(array_diff($_this_tourist_ids, $_previous_tourist_ids) ) ) ) {

                $return_array[$this_version]['new_tourists'] = $new_tourists;

                }

                if(!empty($deleted_tourists = array_keys(array_diff($_previous_tourist_ids, $_this_tourist_ids) ) ) ) {

                $return_array[$this_version]['deleted_tourists'] = $deleted_tourists;

                }

  
                /// CHECK FOR CHANGES IN TOURISTS WHICH STAY IN THIS VERSION:

                $_this_tourist_versions = [];

                foreach ($_this['tourists'] as $key => $tourist) {
                    
                    $_this_tourist_versions[$tourist['tourist_id']]['version'] = $tourist['version'];
                    $_this_tourist_versions[$tourist['tourist_id']]['position'] = $key;


                }

                $_previous_tourist_versions = [];

                foreach ($_previous['tourists'] as $key => $tourist) {
                    
                    $_previous_tourist_versions[$tourist['tourist_id']]['version'] = $tourist['version'];
                    $_previous_tourist_versions[$tourist['tourist_id']]['position'] = $key;

                }


                // dump('this', $_this_tourist_versions, 'previous', $_previous_tourist_versions);

                // dump($_this_tourist_versions);


                    // dump($i);

                    // dump('previous_tourist_versions', $_previous_tourist_versions);
                   
                    // dump('previous[tourists]', $_previous['tourists']);

                    // dump('this_tourist_versions', $_this_tourist_versions);

                    // dump('this[tourists]', $_this['tourists']);




                foreach ($_this_tourist_versions as $this_tourist_id => $this_tourist_values) {


                    if(isset($_previous_tourist_versions[$this_tourist_id])) {

                            $this_tourist_position = $this_tourist_values['position'];
                            $previous_tourist_position = $_previous_tourist_versions[$this_tourist_id]['position'];

                            $this_tourist = $_this['tourists'][$this_tourist_position];
                            $previous_tourist = $_previous['tourists'][$previous_tourist_position];

                            $this_tourist_docs_ids = [];
                            $previous_tourist_docs_ids = [];


                            // dump($this_tourist['docs'], $previous_tourist['docs']);


                            foreach ($this_tourist['docs'] as $key => $value) {

                                $this_tourist_docs_ids[] =  $value['doc_id'];

                            }

                            foreach ($previous_tourist['docs'] as $key => $value) {

                                $previous_tourist_docs_ids[] =  $value['doc_id'];

                            }


                            // dump($this_tourist_docs_ids, $previous_tourist_docs_ids);

                            // die();

                            $new_document_positions = array_keys(array_diff($this_tourist_docs_ids, $previous_tourist_docs_ids));

                            $deleted_document_positions = array_keys(array_diff($previous_tourist_docs_ids, $this_tourist_docs_ids));




                            if(!empty($new_document_positions)) {
                            
                                $return_array[$this_version]['new_documents'][$this_tourist_position] = $new_document_positions;
                            
                            }


                            if(!empty($deleted_document_positions)) {

                                $return_array[$this_version]['deleted_documents'][$this_tourist_position]['previous_tourist_position'] = $previous_tourist_position;                          

                                $return_array[$this_version]['deleted_documents'][$this_tourist_position]['previous_document_positions'] = $deleted_document_positions;
                            
                            }


                            foreach ($this_tourist['docs'] as $this_doc_position => $this_values) {

                                foreach ($previous_tourist['docs'] as $previous_doc_position => $previous_values) {
                                    
                                    if($this_values['doc_id'] == $previous_values['doc_id']) {

                                        if($this_values['version'] != $previous_values['version']){

                                            $this_doc_to_check = array_filter($this_tourist['docs'][$this_doc_position], function($k) {
                                                                                        return $k == 'date_issue' OR $k == 'date_expire' OR $k == 'who_issued' 
                                                                                        OR $k == 'address_pass' OR $k == 'address_real';
                                                                                    }, ARRAY_FILTER_USE_KEY);

                                            $previous_doc_to_check = array_filter($previous_tourist['docs'][$previous_doc_position],                                                                        function($k) {
                                                                                        return $k == 'date_issue' OR $k == 'date_expire' OR $k == 'who_issued' OR $k == 'address_pass' OR $k == 'address_real';
                                                                                    }, ARRAY_FILTER_USE_KEY);

                                            $differences_docs = array_keys(array_diff($this_doc_to_check, $previous_doc_to_check));


                                            $return_array[$this_version]['differences_docs'][$this_tourist_position][$this_doc_position]= $differences_docs;


                                        }

                                    }

                                }

                            }

                            // dump($return_array[$this_version]);
                            // die();


                            // dump($return_array[$this_version]);

                        // CHECKING IF TOURIST EXISTING IN BOTH PREVIOUS AND CURRENT VERSIONS HAS THE SAME VERSIONS


                        if($_previous_tourist_versions[$this_tourist_id]['version'] != $this_tourist_values['version']) {


                            $this_tourist_to_check = array_filter($this_tourist, function($k) {
                                                                                return $k != 'docs';
                                                                            }, ARRAY_FILTER_USE_KEY);

                            $previous_tourist_to_check = array_filter($previous_tourist, function($k) {
                                                                                return $k != 'docs';
                                                                            }, ARRAY_FILTER_USE_KEY);


                            $differences_tourists = array_keys(array_diff($this_tourist_to_check, $previous_tourist_to_check));

                            $return_array[$this_version]['differences_tourists'][$this_tourist_position] = array_filter($differences_tourists, function($v) {
                                                                                return  !in_array($v, ['version', 'id', 'created_at', 'updated_at']);
                                                                            });

                            // dump($return_array[$this_version]);


                        }


                    }

                }

              /// BUYER CHANGES


                $_this_tourist_who_is_buyer_position = $_this['buyer']['is_buyer'];
                $_previous_tourist_who_is_buyer_position = $_previous['buyer']['is_buyer'];


                if( $_this['tourists'][$_this_tourist_who_is_buyer_position]['tourist_id'] != $_previous['tourists'][$_previous_tourist_who_is_buyer_position]['tourist_id']) 

                {

                    $return_array[$this_version]['differences_buyer'] = 'different_buyer';


// dd( ( isset($deleted_tourists) AND !in_array($_previous_tourist_who_is_buyer_position, $deleted_tourists) )

//                         OR (!isset($deleted_tourists)) );


                    if( ( isset($deleted_tourists) AND !in_array($_previous_tourist_who_is_buyer_position, $deleted_tourists) ) 

                        OR (!isset($deleted_tourists)) )

                    {

                        $id_of_previous_tourist = $_previous['tourists'][$_previous_tourist_who_is_buyer_position]['tourist_id'];

                        $return_array[$this_version]['previous_buyer_not_in_deleted'] = $_this_tourist_versions[$id_of_previous_tourist]['position'];

                    }

// dump($this_version, $return_array[$this_version]);


                } else if ($_this['buyer']['is_tourist'] != $_previous['buyer']['is_tourist'])

                {

                    $return_array[$this_version]['differences_buyer'] = 'different_tourist';

                }                



            }

            $i++;




        }

// die();



        foreach ($return_array as $key => $version) {

            foreach ($version['tourists'] as $key_t => $tourist) {

                if ($tourist['patronymic'] == null ) { $return_array[$key]['tourists'][$key_t]['patronymic'] = '&nbsp';}
                if ($tourist['phone'] == null ) { $return_array[$key]['tourists'][$key_t]['phone'] = '&nbsp';}
                if ($tourist['email'] == null ) { $return_array[$key]['tourists'][$key_t]['email'] = '&nbsp';}

             foreach ($tourist['docs'] as $key_d => $document) {

                    if ($document['date_expire'] == null ) { $return_array[$key]['tourists'][$key_t]['docs'][$key_d]['date_expire'] = '&nbsp';}
                    if ($document['who_issued'] == null ) { $return_array[$key]['tourists'][$key_t]['docs'][$key_d]['who_issued'] = '&nbsp';}
                    if ($document['address_pass'] == null ) { $return_array[$key]['tourists'][$key_t]['docs'][$key_d]['address_pass'] = '&nbsp';}
                    if ($document['address_real'] == null ) { $return_array[$key]['tourists'][$key_t]['docs'][$key_d]['address_real'] = '&nbsp';}

                }


            }

   
           
        }

return $return_array;

    }
    




}
