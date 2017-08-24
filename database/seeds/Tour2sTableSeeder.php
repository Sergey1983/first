<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Tour2sTableSeeder extends Seeder
{

    public function run()

    {
        

    	$faker = Faker::create('ru_RU');

    	for ($i=1; $i <=10; $i++) {

      	DB::table('tour2s')->insert([

      		'сity_from' => $faker->randomElement($array = array ('Оренбург','Москва','Минск', 'Актобе')),
      		'hotel' => $faker->sentence($nbWords = 2, $variableNbWords = true),
      		'created_at' => \Carbon\Carbon::now(),
      		'updated_at' => \Carbon\Carbon::now(),


        		]);
        }
    }
}