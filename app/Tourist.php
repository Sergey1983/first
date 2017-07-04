<?php

namespace App;

class Tourist extends Model
{
    public function tour2s() {

		return $this->belongsToMany('App\Tour2')
  	->withTimestamps();

	}

		public function store(Request $request)
	
	{
		    
			Tourist::create( $request->all() );

		    return redirect('/tours_2');
	}

}