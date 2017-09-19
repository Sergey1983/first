<?php

namespace App;

use App\Traits\Excludable;


class Document extends Model
{

    use Excludable;

    
        public function user() {

    	return $this->belongsTo('App\User');

   		 }

        public function tour() {

    	return $this->belongsToMany('App\Tour');

   		}


        public function tourist() {

    	return $this->belongsTo('App\Tourist');

   		 }


}


