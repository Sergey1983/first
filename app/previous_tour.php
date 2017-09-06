<?php

namespace App;

class previous_tour extends Model
{


	public function user () {

		return $this->belongsTo('App\User');
	}

}