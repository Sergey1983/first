<?php

namespace App;

class previousversionstour2 extends Model
{


	public function user () {

		return $this->belongsTo('App\User');
	}

}