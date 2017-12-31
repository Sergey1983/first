<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

use App\Tour;


class Airport extends Model
{
    
    public function tours ()

    {

		return $this->hasMany('App\Tour');
	}

    public function previous_tour ()

    {

		return $this->hasMany('App\previous_tour');
	}

   public function airports_array($country)
    
    {

// ::all()->where('country', 'Беларусь')->sortBy('city')

        $airports = $this->all()->where('country', $country)->sortBy('city');

        $airports_array['-'] = '-';

        // foreach ($airports as $airport) {
            
        //     $airports_array[$airport->code] = $airport->code.', '.$airport->name.', '.$airport->city;

        // }

		$airports->each(function($airport, $key) use (&$airports_array) { $airports_array[$airport->code] = $airport->code.', '.$airport->name.', '.$airport->city; });

        return $airports_array;
    }

}

