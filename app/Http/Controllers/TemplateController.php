<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\Contract_template;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    public function create() {

    	return view('Templates.create_template');
    }

    public function store(Request $request ) {


    	   	// $request->merge(['template_text' => $clean_template_text]);

    	   	$request->merge(['template_text' => self::CleanHTML($request)]);    	   	

	        Contract_template::create($request->all());

	        // return 'success';

			// return redirect()->back();

	        // Storage::disk('local')->put('file.html', $request->template_text);

    }

    public function edit() {

		    return view('Templates.edit_template');

    }

    public function update(Request $request) {

    	   	$request->merge(['template_text' => self::CleanHTML($request)]);    	   	

	        Contract_template::get()->last()->update(['template_text' => $request->template_text]);

    }
 

    public function getHtml(Request $request)
    
    {
    
   		$html = Contract_template::get()->last()->template_text;
	
   		return $html;
    }

    public function cleanHTML ($request) {

    	    $from = ['<br>', '<b>', '</b>', '<table class="table table-bordered">', '<table class="table no-border">', '<i>', '</i>'];
    		
    		$to = ['', '<strong>', '</strong>', '<table class="table table-bordered" style="width: 100%; border-color: #000000; border-width: 2px">', '<table class="table no-border" style="width: 100%">', '<em>', '</em>'];

    		return $clean_template_text = str_replace($from, $to, $request->template_text);
    }

}