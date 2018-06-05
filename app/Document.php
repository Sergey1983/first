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


        public function previous_versions_of_document() {

      return $this->hasMany('App\previous_document', 'doc_id');

      }

}


