<?php

namespace App;

class previoustour2_tourist extends Model

{

    public function user() {

        return $this->hasOne('App\User', 'id', 'user_id');
    }  

}
