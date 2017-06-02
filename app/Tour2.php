<?php

namespace App;

class Tour2 extends Model
{
    public function tourists() {

   		return $this->belongsToMany('App\Tourist')
      	->withTimestamps();

    }
}
