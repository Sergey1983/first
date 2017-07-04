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
	


			Test::create($request->all());

		    return redirect('/testform');
	}


	public function new(Request $request) 
	{
		return redirect('/tours_2');		
	}
}
