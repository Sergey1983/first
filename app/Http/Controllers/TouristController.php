<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tourist;

class 
 extends Controller

{
   
    public function store(Request $request)

    {
            
            Tourist::create( $request->all() );

            return redirect('/tours_2');

    }

}
