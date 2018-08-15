<?php

namespace App;

use App\Traits\Excludable;

use App\Services\Translit;

use App\Events\TouristUpdated;

use Illuminate\Support\Facades\Schema;

class Tourist extends Model
{

	use Excludable;


	// protected static function boot()

	// {
	//     parent::boot();

	//     static::updated(function ($model) {

	//         $collector = resolve('touristsCollector');
	//         $collector->updated[] = $model;

	//     });
	// }



	
    public function tours() {

		return $this->belongsToMany('App\Tour')->withPivot('is_buyer', 'is_tourist', 'user_id', 'doc0', 'doc1')->withTimestamps();

	}

    public function tour_tourist() {

      return $this->hasMany('App\Tour_tourist');

    }


    public function previous_versions_of_tourist() {

    	return $this->hasMany('App\previous_tourist');
    }




     public function documents()

    {
    	return $this->hasMany('App\Document');
    }
    
    

	public static function is_buyer_is_tourist ($request, $i) {

            if ($request['is_buyer'] == $i) { 

                $is_buyer = 1;

                $is_tourist = $request['is_tourist']; // Buyer can be a tourist or not (1 or 0)

            } else {

                $is_buyer = 0;

                $is_tourist = 1; // Tourist (no buyer) is always tourist

            }

            return ['is_buyer' => $is_buyer, 'is_tourist' => $is_tourist];

	}






	 public function createFromRequest (array $request, $i) {


		$tourist = Tourist::create([
						'name' => $request['name'][$i], 
				        'lastName' => $request['lastName'][$i],
				        'nameEng' => Translit::translit($request['name'][$i]),
				        'lastNameEng' => Translit::translit($request['lastName'][$i]),
				        'birth_date' => $request['birth_date'][$i],
				        'doc_fullnumber' => $request['doc_fullnumber'][$i]
				      ]);

		return $tourist;
	}


	public static function updateTouristWithThisDoc($tourist_to_update, $id)


    {

    		$tourist = Tourist::find($id);

    		// $request = $request->except('_token');

	   		// Convert $request to 1 dimensional array:

    		foreach ($tourist_to_update as $key => $value) {

    			foreach ($value as $k => $v) {

    				$tourist_to_update[$key] = $v;

    			}
    			


    		}
    		// End;

                // dump($tourist_to_update);

			$tourist->fill($tourist_to_update);    		

    		$tourist->save();


    }


	public static function getTableFields () {

		$columns = Schema::getColumnListing('tourists');

		$to_remove = ['id', 'created_at', 'updated_at'];   

		$columns = array_diff($columns, $to_remove);

		$columns = array_values($columns);

		return $columns;


	}

	public static function FieldsForValidation () {

		$columns = Tourist::getTableFields();

		$to_delete = array('doc_fullnumber', 'lastNameEng', 'nameEng');

        $columns = array_diff($columns, $to_delete);

        $columns = array_values($columns);

        return $columns;



	}




}