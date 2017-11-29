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

$phpWord = new \PhpOffice\PhpWord\PhpWord();
$phpWord->setDefaultParagraphStyle(
    array(
        'alignment'  => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,
        'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(12),
        'spacing'    => 120,
    )
);
// New section
$section = $phpWord->addSection();

$textrun = $section->addTextRun();

$textrun->addText(
    'Paragraph with keepNext = true (default: false). '
        . '"Keep with next" is used to prevent Word from inserting automatic page '
        . 'breaks between paragraphs. Set this option to "true" if you do not want '
        . 'your paragraph to be separated with the next paragraph.',
    array('indentation' => array('firstLine' => 240))
);











  	$filename = 'Тест.docx';
		  
	Storage::makeDirectory('/test/');		  

    $phpWord->save(storage_path('app').'/test/'.$filename);

  	$source = storage_path('app').'/test/'.$filename;

	// $phpWord = \PhpOffice\PhpWord\IOFactory::load($source);

	return response()->download(storage_path('app').'/test/'.$filename);




	              // $filename = 'newfile.docx';



	          // return redirect()->back();
  }

}
