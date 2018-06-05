<?php

namespace App;

class Contract extends Model
{
    
	public function tour() {

   		return $this->belongsTo('App\Tour');

    }

	public function user() {

   		return $this->belongsTo('App\User');

    }

}
