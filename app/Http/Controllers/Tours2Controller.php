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

use App\Services\SortRequest;

use App\Services\CheckRequest;

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

        $request_sorted = SortRequest::return_sorted($request);


        $request_sorted['user'] = ['user_id'=> request()->user()->id];


        return self::PreProcess($request_sorted, $tour='null', 'save');


        // if(isset($request_sorted['allchecked']) AND $request_sorted['allchecked'] == true) {

        //     $tour = Tour::create(array_merge($request_sorted['tour'], $request_sorted['user']));

        //     $tourists_and_documents['tourists'] = $request_sorted['tourists'];
        //     $tourists_and_documents['documents'] = $request_sorted['documents'];

        //     self::SaveTouristsAndDocuments($tourists_and_documents, $request_sorted['buyer'], $request_sorted['user'], $tour);

        //     return 'success';

        // } else {

        // $checked_tourists_and_documents = CheckRequest::return_checked_tourists_and_docs($request_sorted['tourists'], $request_sorted['documents']);

        //      if(isset($checked_tourists_and_documents['fatal_error'])) {

        //         return $checked_tourists_and_documents;

        //     }

        // // dump($checked_tourists_and_documents);

        // $check = CheckRequest::checkWhatToDo($checked_tourists_and_documents);

        // // dump($check);
        // // die();

        // switch($check) {

        //     case "save":

        //         $tour = Tour::create(array_merge($request_sorted['tour'], $request_sorted['user']));

        //         self::SaveTouristsAndDocuments($checked_tourists_and_documents, $request_sorted['buyer'], $request_sorted['user'], $tour);

        //         return 'success';

        //     break;

        //     case "checkifsame":


        //         $result = CheckRequest::CheckIfTourTouristDocsExists($request_sorted['tour'], $request_sorted['buyer'], $checked_tourists_and_documents);

        //         if($result === false) {
    
        //             $tour = Tour::create(array_merge($request_sorted['tour'], $request_sorted['user']));

        //             self::SaveTouristsAndDocuments($checked_tourists_and_documents, $request_sorted['buyer'], $request_sorted['user'], $tour);

        //             return 'success';

        //         } else {


        //             return array_merge(['fatal_error' => true, 'type' => 'already_exists'], $result);


        //         }


        //     break;

        //     case "update":

        //         return $checked_tourists_and_documents;

        //     break;
        // }















                // CheckRequest::CheckIfTourTouristDocsExists($request_sorted['tour'], $request_sorted['buyer'], $checked_tourists_and_documents);


        // // if($AllNewOrDoesntNeedToBeUpdated) {

        // //         $tour = Tour::create(array_merge($request_sorted['tour'], $request_sorted['user']));

        // //         self::SaveTouristsAndDocuments($checked_tourists_and_documents, $request_sorted['buyer'], $request_sorted['user'], $tour);

        // //         return 'success';

        // //     } else {

        // //         return $checked_tourists_and_documents;

        // //     }

        // // }



        // // foreach ($checked_tourists_and_documents as $key => $value) {
            
        // //     $request_sorted[$key] = $value;
        // // }




        // $tour = Tour::create(array_merge($request_sorted['tour'], ['user_id' => $user->id]));



        // $number_of_tourists = count($request->name);
              

        // // $previousVersions = new PreviousVersions;

        // // $tours_to_update_ids = $previousVersions->GetIdsOfToursToSavePreviousVersionsOf($number_of_tourists, $request_sorted['tourists']);


        // // Saving previous versions of tours where exist tourists from request who are going to be updated (not those who stay the same)

        // // foreach ($tours_to_update_ids as $tour_to_update_id) {

        // //     $tour_to_save_version = Tour::find($tour_to_update_id);

        // //     $previousVersions = new PreviousVersions;

        // //     $previousVersions->createVersion($tour_to_save_version);


        // // }


        // for ($i=0; $i < $number_of_tourists; $i++ ) {



        //     // If tourist with such passport exists, then just get it from DB.
 
        //     // if ($tourist = Tourist::where('doc_fullnumber', '=', $request['doc_fullnumber'][$i])->first()) {

        //     //     $tourist_to_update = $request->only("name.$i", "lastName.$i", "birth_date.$i");

        //     //     Tourist::updateTouristWithThisDoc($tourist_to_update, $tourist->id);


        //     // }


        //     // If tourist doesn't exists, then add it to Database:

        //     // else {

        //         $tourist = Tourist::create($request_sorted['tourists'][$i]);

        //         $doc_ids = [];


        //         foreach ($request_sorted['documents'][$i] as $doc_id => $doc_array) {
                    
        //             $document = Document::create(array_merge(['tourist_id'=>$tourist->id, 'user_id'=> $user->id], $doc_array));

        //             $doc_ids['doc'.$doc_id] = $document->id;

        //             }

        //         // $tourist = new Tourist;

        //         // $tourist = $tourist->createFromRequest($request->all(), $i);


        //     // }


        //     // Check if tourist is a buyer, and if so, if the buyer is a tourist.

        //     $is_buyer_is_tourist = Tourist::is_buyer_is_tourist($request_sorted['buyer'], $i);


        //     $tour->tourists()

        //         ->save($tourist, array_merge($is_buyer_is_tourist, ['user_id' => $user->id], $doc_ids));              








        // }

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

        $tour_tourists_docs = $tour->tour_tourist;

        $is_versions = 0;

        $versions = previous_tour::where('tour_id', $tour->id)->orderBy('version', 'desc')->first();

        if(count($versions) > 0) {

            $is_versions = 1;
        } 



        return view('Tours2.tours2_show', compact('tour', 'tour_tourists', 'tour_tourists_docs', 'is_versions', 'user'));
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



        $request_sorted = SortRequest::return_sorted($request);

        $request_sorted['user'] = ['user_id'=> request()->user()->id];

        $tour = Tour::find($id);

        $is_tour_no_updates = CheckRequest::checkTourForUpdates($request_sorted['tour'], $id);

        return self::PreProcess($request_sorted, $tour, 'update', $is_tour_no_updates);







        // $tour = Tour::find($id);


        // $tour->update(array_merge($request_sorted['tour'], $request_sorted['user']));

        // $checked_tourists_and_documents = CheckRequest::return_checked_tourists_and_docs($request_sorted['tourists'], $request_sorted['documents']);

        // self::SaveTouristsAndDocuments($checked_tourists_and_documents, $request_sorted['buyer'], $request_sorted['user'], $tour, 'update');


        // return 'success';





        // foreach ($checked_tourists_and_documents as $key => $value) {
            
        //     $request_sorted[$key] = $value;
        // }

        // $ifBuyerSame = CheckRequest::checkIfBuyerSame($request_sorted['buyer'], $checked_tourists_and_documents, $id);


        // $number_of_tourists = count(request()->name);


//RECORDING VERSION OF TOUR-TOURIST

        // $tour=Tour::find($id);


        // $previousVersions = new PreviousVersions;

        // $previousVersions->createVersion($tour);


// UPDATING TOUR-TOURIST


        // $tour->update($request_sorted['tour']);


        // $sync_tourist_array = [];

        // $updated = [];



        // $previousVersions = new PreviousVersions;

        // $tours_to_update_ids = $previousVersions->GetIdsOfToursToSavePreviousVersionsOf($number_of_tourists, $request_sorted['tourists']);




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

        // $tours_to_update_ids = array_diff($tours_to_update_ids, [0=>$id]) ;

        // Saving previous versions of tours where exist tourists from request who are going to be updated (not those who stay the same)

        // foreach ($tours_to_update_ids as $tour_to_update_id) {

        //     $tour_to_save_version = Tour::find($tour_to_update_id);

        //     $previousVersions = new PreviousVersions;

        //     $previousVersions->createVersion($tour_to_save_version);


        // }




        // for($i=0; $i<$number_of_tourists; $i++) {

            // Create array ['attribute' => request_value]



            

            // foreach ($request_sorted['tourists'] as $key => $value) {
                
            //         $tourist_to_update[$key] = $value[$i];
  
            // }


            // $tourist = Tourist::updateOrCreate(['doc_fullnumber' => $request['doc_fullnumber'][$i]], $tourist_to_update);


            // Check if tourist is a buyer, and if so, if the buyer is a tourist.




            // if ($request['is_buyer'] == $i) { 

            //     $is_buyer = 1;

            //     $is_tourist = $request['is_tourist']; // Buyer can be a tourist or not (1 or 0)

            // } else {

            //     $is_buyer = 0;

            //     $is_tourist = 1; // Tourist (no buyer) is always tourist

            // }

            

            // $is_buyer_is_tourist = Tourist::is_buyer_is_tourist($request_sorted['buyer'], $i);
            
            // $sync_tourist_array[$tourist->id] = array_merge($is_buyer_is_tourist, ['user_id'=>$user->id]);

            // $sync_tourist_array[$tourist->id] = ['is_buyer' => $is_buyer, 'is_tourist' => $is_tourist];


        // };

        // $collector = resolve('touristsCollector');


        // $something = TouristServices::UpdateOtherToursWithTourists($collector->updated);


        // $tour->tourists()->sync($sync_tourist_array);


        
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


    public static function PreProcess($request_sorted, $tour, $action, $is_tour_no_updates='not exists')

    {


       if(isset($request_sorted['allchecked']) AND $request_sorted['allchecked'] == true) {

            if($action == 'save') { 

                $tour = Tour::create(array_merge($request_sorted['tour'], $request_sorted['user'])); 

            } else if ($action == 'update') {

                // PreviousVersions::createVersion($tour);

                   if(!$is_tour_no_updates) { 

                        $tour->update(array_merge($request_sorted['tour'], $request_sorted['user'])); 


                    }

            }


            $tourists_and_documents['tourists'] = $request_sorted['tourists'];
            $tourists_and_documents['documents'] = $request_sorted['documents'];

            self::SaveTouristsAndDocuments($tourists_and_documents, $request_sorted['buyer'], $request_sorted['user'], $tour, $action);


            PreviousVersions::createVersion($tour);

            return 'success';

        } else {

        $checked_tourists_and_documents = CheckRequest::return_checked_tourists_and_docs($request_sorted['tourists'], $request_sorted['documents']);



             if(isset($checked_tourists_and_documents['fatal_error'])) {

                return $checked_tourists_and_documents;

            }


        $check = CheckRequest::checkWhatToDo($checked_tourists_and_documents);


        switch($check) {

            case "save":

              if($action == 'save') { 

                    $tour = Tour::create(array_merge($request_sorted['tour'], $request_sorted['user'])); 

                } else if ($action == 'update') {

                    // PreviousVersions::createVersion($tour);

                       if(!$is_tour_no_updates) { 

                            $tour->update(array_merge($request_sorted['tour'], $request_sorted['user'])); 

                        }

                }

                self::SaveTouristsAndDocuments($checked_tourists_and_documents, $request_sorted['buyer'], $request_sorted['user'], $tour, $action);

                PreviousVersions::createVersion($tour);

                return 'success';

            break;

            case "checkifsame":

                $result = CheckRequest::CheckIfTourTouristDocsExists($request_sorted['tour'], $request_sorted['buyer'], $checked_tourists_and_documents);

                if($result === false) {
    
                  if($action == 'save') { 

                        $tour = Tour::create(array_merge($request_sorted['tour'], $request_sorted['user'])); 

                    } else if ($action == 'update') {

                        // PreviousVersions::createVersion($tour);

                           if(!$is_tour_no_updates) { 

                                $tour->update(array_merge($request_sorted['tour'], $request_sorted['user'])); 

                            }

                    }
                    
                    self::SaveTouristsAndDocuments($checked_tourists_and_documents, $request_sorted['buyer'], $request_sorted['user'], $tour, $action);

                    PreviousVersions::createVersion($tour);

                    return 'success';

                } else {

                    return array_merge(['fatal_error' => true, 'type' => 'already_exists'], $result);

                }


            break;

            case "update":

                return $checked_tourists_and_documents;

            break;
        }

    }





    }


    public static function SaveTouristsAndDocuments($checked_array, $buyer_array, $user_array, $tour, $action) {

        // dd($checked_array);



        $number_of_tourists = count($checked_array['tourists']);

        foreach ($checked_array['tourists'] as $tourist_number => $tourist_values) {


            if($tourist_values['check_info']['exists'] == false) {

                $tourist = Tourist::create(self::unsetCheckInfo($tourist_values));

            } else if ($tourist_values['check_info']['exists'] == true) {

                    $tourist = Tourist::find($tourist_values['check_info']['id']);

                if (isset($tourist_values['check_info']['to_be_updated'])) {

                    $tourist->update(self::unsetCheckInfo($tourist_values));

                } 

            }

            $doc_ids = [];

            foreach ($checked_array['documents'][$tourist_number] as $doc_id => $doc_values) {
                


                if($doc_values['check_info']['exists'] == false) {

                    $document = Document::create(array_merge(['tourist_id'=>$tourist->id], $user_array, self::unsetCheckInfo($doc_values)));

                } else if($doc_values['check_info']['exists'] == true) {

                    $document = Document::find($doc_values['check_info']['id']);

                        if (isset($doc_values['check_info']['to_be_updated'])) {

                        $document->update(self::unsetCheckInfo($doc_values));

                        } 

                }

                    $doc_ids['doc'.$doc_id] = $document->id;



            }

            $is_buyer_is_tourist = Tourist::is_buyer_is_tourist($buyer_array, $tourist_number);

            if($action == 'save') { 
            
            $tour->tourists()

                ->save($tourist, array_merge($is_buyer_is_tourist, $user_array, $doc_ids));   

            } else if($action == 'update') {


                $update_array[$tourist->id] = array_merge($is_buyer_is_tourist, $doc_ids, $user_array);
            }


        }


        if($action == 'update') {

            $tour->tourists()->sync($update_array);
        }

    }


    public static function unsetCheckInfo ($array) {

        unset($array['check_info']);

        return $array;

    }

}
