<?php

namespace App\Http\Controllers;

use App\Tour;

use Illuminate\Http\Request;

class ToursSearchController extends Controller
{
    public function lastName () {


    	$search = request('search');

    	$search = preg_replace("#[^0-9a-z]#i", "", $search);

    	$query = "where('lastName', 'LIKE', $search)->get()";

    	return redirect()->route('tours_list')->with('data' => $query);;


    }
}
