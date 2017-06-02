<?php

use Illuminate\Database\Seeder;
use App\Translit;
use Faker\Factory as Faker;

class ToursTableSeeder extends Seeder
{

    public function run()
    
    {
        



    	$faker = Faker::create('ru_RU');

    	for ($i=1; $i <=1000; $i++) {

      	DB::table('tours')->insert([

      		'name' => ($a = $faker->firstName),
      		'lastName' => ($b = $faker->lastName),
      		'nameEng' => Translit::translit($a),
      		'lastNameEng' => Translit::translit($b),
      		'destination' => $faker->randomElement($array = array ('Турция','Египет','Тайланд', 'Кипр')) ,
      		'departure' => $faker->date($format = 'd-m-Y', $max = 'now'),
      		'created_at' => \Carbon\Carbon::now(),
      		'updated_at' => \Carbon\Carbon::now(),


    		]);

    	}


    	


    }
}
