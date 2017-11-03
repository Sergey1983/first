<?php

namespace App\Http\Controllers;

use App\Tour;

use Illuminate\Http\Request;



class TestController extends Controller

{

public function download($id ='', $filename = '' ) { 

// Check if file exists in storage directory


 $file_path = storage_path('app/public/contracts/'.$id.'/') . $filename; 

 
 if ( file_exists( $file_path ) ) { 

	return response()->download($file_path);


  // \Response::download( $file_path, $filename ); 

  } else { // Error

   exit( 'Requested file does not exist on our server!' );

    } }

}
