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

// dd($request->template_text);
	        Contract_template::create($request->all());

return redirect()->back();

	        // Storage::disk('local')->put('file.html', $request->template_text);

    }


}