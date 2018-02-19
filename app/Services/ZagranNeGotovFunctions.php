<?php

namespace App\Services;

use App\ZagranNeGotovNumber;
use Illuminate\Support\Facades\DB;

class ZagranNeGotovFunctions {

    public function get_number() {

    	if(ZagranNeGotovNumber::get()->isEmpty()) {

    		$number = ZagranNeGotovNumber::create(['number' => '1111111111']);

    		$number = $number->number;


    	
    	} else {
    
    	$number = ZagranNeGotovNumber::orderBy('number', 'desc')->first()->number;

    	DB::table('zagran_ne_gotov_numbers')->truncate();

    	$number = ZagranNeGotovNumber::create(['number' => $number+1]);

    	$number = $number->number;

		}

    	return $number;

    }


}