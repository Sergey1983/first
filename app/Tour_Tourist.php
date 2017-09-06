<?php

namespace App;

class tour_tourist extends Model
{

	protected $table='tour_tourist';
    

	public function user () {

		return $this->belongsTo('App\User', 'user_id');

	}

	public function tour () {

		return $this->belongsTo('App\Tour', 'tour_id');
	}


}
