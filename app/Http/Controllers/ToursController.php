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

use App\Services\Printing;

use App\Cities;

use App\Test;

use App\previous_tour;

use App\previous_tourist;

use App\previous_tour_tourist;

use App\Events\TouristUpdated;

use App\Listeners\ExtractUpdatedTourist;

use Event;



class ToursController extends Controller

{
 
    public function index()

    {

            return view('Tours.Index.tours');

    }



    public function create($tour_type)
    
    {

        $tour_type_rus = Printing::tour_type($tour_type);

        return view('Tours.CreateOrEdit.create', compact('tour_type', 'tour_type_rus'));
    
    }



    public function store(tourRequest $request)

    {

        $request_sorted = SortRequest::return_sorted($request);

        $request_sorted['user'] = ['user_id'=> request()->user()->id];

        $request_sorted['branch'] = ['branch_id'=> request()->user()->branch->id];

        return self::PreProcess($request_sorted, $tour=null, 'save');


    }


    public function show(Tour $tour)
    
    {

        $user = $tour->users;

        $tour_type = Printing::tour_type_reverse($tour->tour_type);

        $tour_tourists = $tour->tourists;

        $tour_tourists_docs = $tour->tour_tourist;

        $is_versions = previous_tour_tourist::where('tour_id', $tour->id)->get()->isNotEmpty() ? 1 : 0;

        return view('Tours.Show.show', compact('tour', 'tour_tourists', 'tour_tourists_docs', 'is_versions', 'user', 'tour_type'));
    }

 

    public function edit(Tour $tour, $tour_type)

    {
  
        $tour_type_rus = Printing::tour_type($tour_type);
        
        return view('Tours.CreateOrEdit.edit', compact('tour', 'tour_type', 'tour_type_rus'));

    }



    public function update(tourRequest $request, Tour $tour)

    {


        $user = request()->user();

        $request_sorted = SortRequest::return_sorted($request);

        $request_sorted['user'] = ['user_id'=> $user->id];

        $request_sorted['branch'] = $user->isAdmin() ? ['branch_id'=> request()->branch_id] : ['branch_id'=> $tour->branch_id];

        $is_tour_no_updates = CheckRequest::checkTourForUpdates($request_sorted['tour'], $tour->id);

        return self::PreProcess($request_sorted, $tour, 'update', $is_tour_no_updates);

        
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

                $tour = Tour::create(array_merge($request_sorted['tour'], $request_sorted['user'], $request_sorted['branch'])); 

            } else if ($action == 'update') {

                   if(!$is_tour_no_updates) { 

                        $tour->update(array_merge($request_sorted['tour'], $request_sorted['user'], $request_sorted['branch'])); 

                    }

            }

// dump('$tour->tourists2', $tour->tourists);

            $tourists_and_documents['tourists'] = $request_sorted['tourists'];
            $tourists_and_documents['documents'] = $request_sorted['documents'];

            //Changes happen here...
            self::SaveTouristsAndDocuments($tourists_and_documents, $request_sorted['buyer'], $request_sorted['user'], $tour, $action);

// dump('$tour->tourists2', $tour->tourists);


            PreviousVersions::createVersion($tour);
// die();
            return 'success';

        } else {

        $checked_tourists_and_documents = CheckRequest::return_checked_tourists_and_docs($request_sorted['tourists'], $request_sorted['documents'], $tour);


             if(isset($checked_tourists_and_documents['fatal_error'])) {

                return $checked_tourists_and_documents;

            }


        $check = CheckRequest::checkWhatToDo($checked_tourists_and_documents);


        switch($check) {

            case "save":

// dump('$tour->tourists1', $tour->tour_tourists);

              if($action == 'save') { 

                   $tour = Tour::create(array_merge($request_sorted['tour'], $request_sorted['user'], $request_sorted['branch'])); 

                } else if ($action == 'update') {

                    // PreviousVersions::createVersion($tour);

                       if(!$is_tour_no_updates) { 

                            $tour->update(array_merge($request_sorted['tour'], $request_sorted['user'], $request_sorted['branch'])); 

                        }

                }

                self::SaveTouristsAndDocuments($checked_tourists_and_documents, $request_sorted['buyer'], $request_sorted['user'], $tour, $action);

// dump('$tour->tourists2', $tour->tourists);


                // Блядь, когда в предыдущей функции делается ->sync(), видимо, не успевает обновить relationship между моделями tour->tourist поэтому нужно инициировать $tour еще раз. Может это связано с тем, что у меня в таблице tour_tourists нет id...
                $tour = Tour::find($tour->id);

                            // dump('tour->tourists2', $tour->tourists);


                PreviousVersions::createVersion($tour);
// die();
                return 'success';

            break;


            case "checkifsame":

                $result = CheckRequest::CheckIfTourTouristDocsExists($request_sorted['tour'], $request_sorted['buyer'], $checked_tourists_and_documents);

                if($result === false) {
    
                  if($action == 'save') { 

                     $tour = Tour::create(array_merge($request_sorted['tour'], $request_sorted['user'], $request_sorted['branch'])); 

                    } else if ($action == 'update') {


                           if(!$is_tour_no_updates) { 

                                $tour->update(array_merge($request_sorted['tour'], $request_sorted['user'], $request_sorted['branch'])); 

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

// dump($tour->tourists);
// dump($action);
// dump($checked_array);

        $number_of_tourists = count($checked_array['tourists']);

        $updated_tourists_ids = [];
        $updated_docs_ids = [];

        foreach ($checked_array['tourists'] as $tourist_number => $tourist_values) {


            if($tourist_values['check_info']['exists'] == false) {

                $tourist = Tourist::create(self::unsetCheckInfo($tourist_values));

            } else if ($tourist_values['check_info']['exists'] == true) {

                    $tourist = Tourist::find($tourist_values['check_info']['id']);

                if (isset($tourist_values['check_info']['to_be_updated'])) {

                    $tourist->update(self::unsetCheckInfo($tourist_values));
                    //Collecting ids of updated tourists to update other tours where they are:
                    $updated_tourists_ids[] = $tourist->id;

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
                        //Collecting ids of updated docs to update other tours where they are:
                        $updated_docs_ids[] = $document->id;

                        } 

                }

                    $doc_ids['doc'.$doc_id] = $document->id;




            }


            $doc_ids['doc1'] = isset($doc_ids['doc1']) ? $doc_ids['doc1'] : null;


            $is_buyer_is_tourist = Tourist::is_buyer_is_tourist($buyer_array, $tourist_number);

            if($action == 'save') { 
            
            $tour->tourists()

                ->save($tourist, array_merge($is_buyer_is_tourist, $user_array, $doc_ids));   

            } else if($action == 'update') {

                $update_array[$tourist->id] = array_merge($is_buyer_is_tourist, $doc_ids, $user_array);

            }


        }


        if($action == 'update') {

            // dump($update_array);
            // dump('tour->tourists1', $tour->tourists);

            $tour->tourists()->sync($update_array);

            // $tour = Tour::find($tour->id);

            // dump('tour->tourists2', $tour->tourists);
        }


        if(!empty($updated_tourists_ids) OR !empty($updated_docs_ids)) {

            PreviousVersions::create_version_extra($updated_tourists_ids, $updated_docs_ids, $tour->id, $user_array['user_id']);
        }

    }






    public static function unsetCheckInfo ($array) {

        unset($array['check_info']);

        return $array;

    }

}
