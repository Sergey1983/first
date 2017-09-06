<?php

namespace App;

use App\Traits\Excludable;



class Tour extends Model
{

	use Excludable;

    public function tourists() {

   		return $this->belongsToMany('App\Tourist')->withPivot('is_buyer', 'is_tourist', 'user_id')
      	->withTimestamps();

    }



    public function previous_tours() {

    	return $this->hasMany('App\previous_tour');

    }


    public function user() {

   		return $this->belongsTo('App\User');

    }


    public function tour_tourist() {

      return $this->hasOne('App\Tour_tourist');

    }


    public function previous_tour_tourist() {

      return $this->hasMany('App\previous_tour_tourist');
    }

    public function airport_model () {

    return $this->hasOne('App\Airport', 'code', 'airport');
    
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
