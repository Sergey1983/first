<?php

namespace App;

use App\Traits\Excludable;



class Tour2 extends Model
{

	use Excludable;

    public function tourists() {

   		return $this->belongsToMany('App\Tourist')->withPivot('is_buyer', 'is_tourist', 'user_id')
      	->withTimestamps();

    }



    public function previousVersionsTour2() {

    	return $this->hasMany('App\PreviousVersionsTour2');
    }


    public function user() {

   		return $this->belongsTo('App\User');

    }


    public function tour_tourist() {

      return $this->hasOne('App\Tour2_tourist');

    }


    public function previoustour2_tourist() {

      return $this->hasMany('App\previoustour2_tourist');
    }



}
