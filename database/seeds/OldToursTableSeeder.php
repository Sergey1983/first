<?php

use Illuminate\Database\Seeder;
use App\Services\Translit;
use Faker\Factory as Faker;

class OldToursTableSeeder extends Seeder
{

    public function run()
    
    {
        



    	$faker = Faker::create('ru_RU');

    	for ($i=1; $i <=40000; $i++) {

      	DB::table('tours_old')->insert([

      		'name' => ($a = $faker->firstName),
      		'lastName' => ($b = $faker->lastName),
      		'nameEng' => Translit::translit($a),
      		'lastNameEng' => Translit::translit($b),
      		'destination' => $faker->randomElement($array = array ('Турция','Египет','Тайланд', 'Кипр')) ,
      		'departure' => $faker->date($format = 'd-m-Y', $max = 'now'),
          'document' => $faker->randomNumber($nbDigits = 7, $strict = false),
      		'created_at' => \Carbon\Carbon::now(),
      		'updated_at' => \Carbon\Carbon::now(),


    		]);

    	}


    	


    }
}
