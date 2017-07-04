<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\TestFormRequest;

use App\Tour2;

use App\Test;


class FormController extends Controller
{

		public function create()
	
	{

		$tests = Test::all();



		return view ('form', compact('tests'));
	}



		public function store(TestFormRequest $request)
	
	{
	


			for ($i=0; $i < count($request); $i++) {

			 Test::create(['fullname' => $request['fullname'][$i],
			 				'document_num' => $request['document_num'][$i]
			 				]);

			}

		     return redirect('/testform');
	}


	public function new(Request $request) 
	{
		return redirect('/tours_2');		
	}
}
