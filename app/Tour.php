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


    public function buyer () {

        return $this->belongsToMany('App\Tourist')->wherePivot('is_buyer', 1);
    }

    public function previous_tours() {

    	return $this->hasMany('App\previous_tour');

    }


    public function user() {

   		return $this->belongsTo('App\User');

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

    return $this->hasOne('App\Operator', 'name', 'operator');
    
    }

    public function payments_from_tourists () {

        return $this->hasMany('App\Payments_from_tourist');
    }

    public function payments_to_operator () {

        return $this->hasMany('App\Payments_to_operator');
    }

            public function payments_to_operator_sum()
            {
                return $this->payments_to_operator->sum('pay');
            }

            public function payments_to_operator_rub_sum()
            {
                return $this->payments_to_operator->sum('pay_rub');
            }


            public function payments_from_tourists_sum()
            {
                return $this->payments_from_tourists->sum('pay');
            }

            public function payments_from_tourists_rub_sum()
            {
                return $this->payments_from_tourists->sum('pay_rub');
            }

}
