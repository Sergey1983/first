<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tour;

class TestFormController extends Controller
{
    public function index() {

    	return view('test.testform');
    }


        public function search(Request $request) {

 
        $destination =  $request->get('destination');

        $name =  $request->get('name');  





        $tours = Tour::where('destination', '=', $destination)
        			   ->where(function($query) use ($name)

        			   {
        			   	
        			   	$query->where('name', 'like', '%'.$name.'%')
        			   		  ->orWhere('lastName', 'like', '%'.$name.'%');

        			   	});


			return $tours->get();

    }
}
