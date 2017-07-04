<?php

namespace App;

use App\Traits\Excludable;



class Tour2 extends Model
{

	use Excludable;

    public function tourists() {

   		return $this->belongsToMany('App\Tourist')->withPivot('is_buyer', 'is_tourist')
      	->withTimestamps();

    }



}
