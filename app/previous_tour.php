<?php

namespace App;

class previous_tour extends Model
{


	public function user () {

		return $this->belongsTo('App\User');
	}

	public function tour () {

		return $this->belongsTo('App\Tour');
	}

	// public function previous_tour_tourist () {

	// 	return $this->hasMany('App\previous_tour_tourist');

	// }

    public function airport_model () {

    return $this->hasOne('App\Airport', 'code', 'airport');
    
    }

}