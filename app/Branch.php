<?php

namespace App;


class Branch extends Model
{

    public function user () {

        return $this->hasMany('App\User');
    }

    public function tours () {

        return $this->hasMany('App\Tour');
    }

    public function payments_from_tourists () {

        return $this->hasManyThrough('App\Payments_from_tourist', 'App\Tour');
    }

}
