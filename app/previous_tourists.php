<?php

namespace App;

use App\Traits\Excludable;


class previous_tourist extends Model
{
    use Excludable;

    public function previous_tour_tourist()
    {
    	return $this->hasMany('App\previous_tour_tourist');

    }



}
