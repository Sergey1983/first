<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\Contract_template;
use Illuminate\Support\Facades\Storage;

class TestFormController extends Controller
{
    public function index() {

    	return view('test.testform');
    }

    public function store(Request $request ) {

// dd($request->template_text);
	        Contract_template::create($request->all());

	        Storage::disk('local')->put('file.html', $request->template_text);

    }


}
