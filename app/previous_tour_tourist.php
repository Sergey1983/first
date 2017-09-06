<?php

namespace App;

class previous_tour_tourist extends Model

{

    public function user() {

        return $this->hasOne('App\User', 'id', 'user_id');
    }  

}
