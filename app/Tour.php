<?php

namespace App;

use App\Traits\Excludable;


class Tour extends Model
{

	use Excludable;


    public function tourists() {

   		return $this->belongsToMany('App\Tourist')->withPivot('is_buyer', 'is_tourist', 'user_id', 'doc0', 'doc1')
      	->withTimestamps();

    }

    public function tourists_only_who_really_go() {

        return $this->belongsToMany('App\Tourist')->wherePivot('is_tourist', 1)->withPivot('is_buyer', 'is_tourist', 'user_id', 'doc0', 'doc1')
        ->withTimestamps();


        // withPivot('is_buyer', 'is_tourist', 'user_id', 'doc0', 'doc1')
        // ->withTimestamps();

    }


    public function buyer () {

        return $this->belongsToMany('App\Tourist')->wherePivot('is_buyer', 1)->withPivot('doc0', 'doc1');
    }

    public function previous_tours() {

    	return $this->hasMany('App\previous_tour');

    }


    public function user() {

   		return $this->belongsTo('App\User');

    }

    public function user_created() {

       return $this->previous_tours->isNotEmpty() ? $this->previous_tours->sortby('created_at')->first()->user->name : $this->user->name;
    }

    public function is_user_diff() {

        if ($this->previous_tours->isNotEmpty()) {

            if($this->user_id != $this->previous_tours->sortby('created_at')->first()->user_id) {

                return [$this->id, $this->user_id, $this->previous_tours->sortby('created_at')->first()->user_id];
            }
        }
    }

    public function change_user_id() {

        $this->user_id = $this->previous_tours->sortby('created_at')->first()->user_id;

        $this->save();

    }

    public function branch() {

        return $this->belongsTo('App\Branch');

    }

    public function country_model() {

        return $this->belongsTo('App\Country', 'country', 'country');

    }


    public function tour_tourist() {

      return $this->hasMany('App\Tour_tourist');

    }

   public function contracts() {

      return $this->hasMany('App\Contract');

    }

    public function previous_tour_tourist() {

      return $this->hasMany('App\previous_tour_tourist');
    }

    public function airport_model () {

    return $this->hasOne('App\Airport', 'code', 'airport');
    
    }

     public function operator_model () {

    return $this->hasOne('App\Operator', 'id', 'operator');
    
    }


    public function payments_from_tourists () {

        return $this->hasMany('App\Payments_from_tourist');
    }

    public function payments_from_tourists_sum() {

        return $this->payments_from_tourists->sum('pay');
    }

    public function payments_from_tourists_rub_sum(){

        return $this->payments_from_tourists->sum('pay_rub');
    }




    public function payments_to_operator () {

        return $this->hasMany('App\Payments_to_operator');
    }

    public function payments_to_operator_sum(){

        return $this->payments_to_operator->sum('pay');
    }

    public function payments_to_operator_rub_sum(){
        
        return $this->payments_to_operator->sum('pay_rub');
    }



}
