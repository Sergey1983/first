<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'permission'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    

    public function roles() {

        return $this->belongsTo('App\Role');
    }    



    public function tours() {

        return $this->hasMany('App\Tour2');

    }

    public function previous_tours () {

        return $this->hasMany('App\previousversionstour2');

    }

    public function previoustour2_tourist () {

        return $this->hasMany('App\previoustour2_tourist', 'user_id', 'id');

    }

    public function tour2_tourist () {

        return $this->hasMany('App\tour2_tourist');
    }

}
