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

    public function tourist () {

        return $this->belongsTo('App\Tourist', 'tourist_id');
    }

    public function document0() {

    return $this->hasOne('App\Document', 'id', 'doc0');

    }

    public function document1() {

    return $this->hasOne('App\Document', 'id', 'doc1');

    }


    public function documents() {

    return $this->document0->merge($this->document1);

    }




}
