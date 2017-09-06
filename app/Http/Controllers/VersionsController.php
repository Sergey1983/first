<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tour;

use App\previous_tour_tourist;

use App\previous_tourist;

use App\previous_tour;

use App\Traits\Excludable;


class VersionsController extends Controller
{

    use Excludable;

    public function show($id)

    {
    	
    	$tour = Tour::find($id);


        $rows_query = previous_tour_tourist::where('tour_id', $tour->id);

        $version_indexes = $rows_query->get()->pluck('this_version')->unique()->toArray();

        $version_indexes = array_values($version_indexes);

        // print_r($version_indexes);

        foreach ($version_indexes as $key => $version) {

            // print_r($version);

            $versions[$key]['this_version'] = $version;

            $query = previous_tour_tourist::where(['tour_id'=>$tour->id, 'this_version'=> $version]);

            $versions[$key]['version_created'] = (clone $query)->select('version_created')->first()->version_created;
            $versions[$key]['tour_version'] = (clone $query)->select('tour_version')->first()->tour_version;
            $versions[$key]['user'] = (clone $query)->first()->user->name;
            $versions[$key]['tour'] = previous_tour::where(['tour_id'=> $id, 'version'=> $versions[$key]['tour_version']])->select('city_from', 'hotel')->first()->toArray();

            $versions[$key]['tourists_versions'] = (clone $query)->select('tourist_id', 'tourist_version', 'is_buyer', 'is_tourist')->get()->toArray();



            foreach ($versions[$key]['tourists_versions']  as $k => $value) {

                $a_query = $value;
                $a_query['version'] = $a_query['tourist_version'];
                unset($a_query['tourist_version']);
                unset($a_query['is_buyer']);
                unset($a_query['is_tourist']);

                $versions[$key]['tourists'][$k] = previous_tourist::where($a_query)->exclude(['id', 'created_at', 'updated_at'])->first()->toArray();
                
                $versions[$key]['tourists'][$k]['is_buyer']= $value['is_buyer']; 
                $versions[$key]['tourists'][$k]['is_tourist']= $value['is_tourist'];

            };





        };


        $versions = array_reverse($versions);

        // print_r($versions);


      

        // die();







    	return view('Tours2.versions', compact('id', 'versions'));



    }
}
