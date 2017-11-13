<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use App\Tour;

class TestController2 extends Controller

{
    public function index () {

    	return view ('test.double_sort');
    }



    public function load_tours(Request $request) {


    if ( $request->ajax() )	

	    { 
	    	$output="";

		$query = (new Tour)->newQuery();

		if($request->has('destination')){
		    $query->where('destination', '=', $request->get('destination'));
		}

		if($request->has('from')){
		    $query->where('departure', '>=', $request->get('from'));
		}

		if($request->has('to')){
		    $query->where('departure', '<=', $request->get('to'));
		}

		if($request->has('name')){
		    $query->where(function($query) use ($request)

        			   {
        			   	
        			   	$query->where('name', 'like', '%'.$request->get('name').'%')
        			   		  ->orWhere('lastName', 'like', '%'.$request->get('name').'%');

        			   	});
		}


	$tours = $query->get();


	return $tours;



    }

  
  }


  public function test()
  
  {

  	$filename = 'Договор-ТА-Клиент.docx';
		  
  	$source = storage_path('app').'/test/'.$filename;

	$phpWord = \PhpOffice\PhpWord\IOFactory::load($source);


	              Storage::makeDirectory('/test/');

	              $filename = 'newfile.docx';

	              $phpWord->save(storage_path('app').'/test/'.$filename);

	 			  return response()->download(storage_path('app').'/test/'.$filename);

	          // return redirect()->back();
  }

}
