<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Country extends Model

{
    protected $table = 'countries';

    public function airports()

    {
    	return $this->hasMany('App\Airport', 'country', 'country');
    }

   public function airports_array()
    
    {


        $airports = $this->airports->sortBy('city');

        $airports_array['-'] = '-';

        foreach ($airports as $airport) {
            
            $airports_array[$airport->code] = $airport->code.', '.$airport->name.', '.$airport->city;

        }

        return $airports_array;
    }
}
