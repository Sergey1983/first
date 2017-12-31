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



    public function role() {

        return $this->belongsTo('App\Role');
    }    

    public function isAdmin() {

        return $this->role->role === "Admin" ? true : false;
    }    


    public function tours() {

        return $this->hasMany('App\Tour');

    }

    public function previous_tours () {

        return $this->hasMany('App\previous_tour');

    }

    public function previous_tour_tourist () {

        return $this->hasMany('App\previous_tour_tourist', 'user_id', 'id');

    }

    public function tour_tourist () {

        return $this->hasMany('App\Tour_tourist');
    }

    public function payments_from_tourists () {

        return $this->hasMany('App\Payments_from_tourist', 'user_id');
    }

    public function payments_from_tourists_deleted_by () {

        return $this->hasMany('App\Payments_from_tourist', 'deleted_by', 'id')->withTrashed();
    }

    public function payments_to_operator () {

        return $this->hasMany('App\Payments_to_operator', 'user_id');
    }

    public function payments_to_operator_deleted_by () {

        return $this->hasMany('App\Payments_to_operator', 'deleted_by', 'id')->withTrashed();
    }

    public function documents()

    {
        return $this->hasMany('App\Document');
    }

    public function branch()

    {

        return $this->belongsTo('App\Branch');
    }
}
