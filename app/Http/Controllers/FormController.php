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
		    
		return view ('form');
	}



		public function store(TestFormRequest $request)
	
	{
		    
			Test::create($request->all());

		    return redirect()->back();
	}


	public function new(Request $request) 
	{
		return redirect('/tours_2');		
	}
}
