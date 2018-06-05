<?php

namespace App;

use App\previous_tour;

class previous_tour_tourist extends Model

{

    public function user() {

        return $this->hasOne('App\User', 'id', 'user_id');
    }  

	public function previous_tour () {

		return $this->hasMany('App\previous_tour', 'version', 'tour_version')->where('tour_id', $this->tour_id);

		// return $this->hasOne('App\previous_tour', 'id', 'tour_id')->where('version', $this->tour_version);

	}


	public function previous_tourist () {

		   return $this->hasMany('App\previous_tourist', 'tourist_id', 'tourist_id')->where('version', $this->tourist_version);


	}


    public function document0() {

    return $this->hasOne('App\Document', 'id', 'doc0');

    }

    public function document1() {

    return $this->hasOne('App\Document', 'id', 'doc1');

    }





}
