<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

use App\Tour;


class Airport extends Model
{
    
    public function tours ()

    {

		return $this->hasMany('App\Tour');
	}

    public function previous_tour ()

    {

		return $this->hasMany('App\previous_tour');
	}



}

