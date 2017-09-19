<?php

namespace App;

class tour_tourist extends Model
{

	protected $table='tour_tourist';
    

	public function user () {

		return $this->belongsTo('App\User', 'user_id');

	}

	public function tour () {

		return $this->belongsTo('App\Tour', 'tour_id');
	}

    public function document1() {

    return $this->hasMany('App\Document', 'id', 'doc0');

    }

    public function document2() {

    return $this->hasMany('App\Document', 'id', 'doc1');

    }


    public function documents() {

    return $this->document1->merge($this->document2);

    }




}
