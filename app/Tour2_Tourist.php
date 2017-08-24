<?php

namespace App;

class tour2_tourist extends Model
{

	protected $table='tour2_tourist';
    

	public function user () {

		return $this->belongsTo('App\User', 'user_id');

	}

	public function tour2 () {

		return $this->belongsTo('App\Tour2', 'tour2_id');
	}


}
