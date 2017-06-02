<?php

namespace App;

class Tourist extends Model
{
        public function tour2s() {

   		return $this->belongsToMany('App\Tour2')
      	->withTimestamps();

    }
}