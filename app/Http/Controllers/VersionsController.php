<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tour;

use App\User;

use App\Airport;

use App\Document;

use App\previous_tour_tourist;

use App\previous_tourist;

use App\previous_tour;

use App\Traits\Excludable;


class VersionsController extends Controller
{

    use Excludable;

    public function show($id)

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

        $tour = Tour::find($id);

        $versions_collection = $tour->previous_tour_tourist;

        foreach ($versions_collection as $version_instance) {
                    
            $versions_array[$version_instance->this_version][] = array_filter($version_instance->toArray(), function($k) {
                                                                                return $k != 'this_version';
                                                                            }, ARRAY_FILTER_USE_KEY);

            }        


            // echo($versions_collection);die();


        foreach ($versions_array as $this_version => $tourists_and_documents) {
        
            $return_array[$this_version]['tour'] = previous_tour::find($tourists_and_documents[0]['tour_version'])->toArray();
            $return_array[$this_version]['tour']['user_name'] = User::find($return_array[$this_version]['tour']['user_id'])->name;


            if($return_array[$this_version]['tour']['airport'] != '-' ) {

                $airport = Airport::where('code', $return_array[$this_version]['tour']['airport'])->first(); 
                
                $return_array[$this_version]['tour']['airport']  = $airport->code.', '.$airport->name.', '.$airport->country;

            }
            

            $return_array[$this_version]['tour']['operator_code'] = (is_null($return_array[$this_version]['tour']['operator_code'])) ? "Заявка ещё не подтверждена" : $return_array[$this_version]['tour']['operator_code'];

    

            $return_array[$this_version]['version_created'] = $tourists_and_documents[0]['version_created'];

            foreach ($tourists_and_documents as $key => $tourist_and_documents) {

                $_this = $tourist_and_documents;
                
                $return_array[$this_version]['tourists'][$key] = previous_tourist::where([['tourist_id', $_this['tourist_id'] ],['version', $_this['tourist_version']]])->first()->toArray();

                $return_array[$this_version]['tourists'][$key]['docs'][0] = Document::find($_this['doc0'])->toArray();

                if(!is_null($_this['doc1'])) {

                    $return_array[$this_version]['tourists'][$key]['docs'][1] = Document::find($_this['doc1'])->toArray();

                }

                if($_this['is_buyer']!=0) {

                    $return_array[$this_version]['buyer']['is_buyer'] = $key;

                    $return_array[$this_version]['buyer']['is_tourist'] =  $_this['is_tourist'];

                }

            }

        }


        return $return_array;

    }
    


}
