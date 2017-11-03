<?php

use Illuminate\Database\Seeder;
use App\Services\Translit;
use Faker\Factory as Faker;

class TouristsTableSeeder extends Seeder

{

    public function run()

    {
        $faker = Faker::create('ru_RU');


    	for ($i=1; $i <=400; $i++) {

    	DB::table('tourists')->insert([

    		'name' => ($a = $faker->firstName),
    		'lastName' => ($b = $faker->lastName),
      		'nameEng' => Translit::translit($a),
      		'lastNameEng' => Translit::translit($b),
			'birth_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
			'citizenship' => 'Россия',
            'gender' => 'Мужчина',
            'phone' => $faker->numberBetween($min = 1000000000, $max = 9999999999),
            'email' => $faker->email(),

			// 'doc_type' => "Внутррос. паспорт",
			// 'seria'  => ($c = $faker->randomNumber($nbDigits = 4, $strict=true)),
			// 'doc_issue' => $faker->date($format = 'd-m-Y', $max = 'now'),
			// 'doc_expires' => $faker->date($format = 'd-m-Y', $max = '+10 years'),
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now(),


    		]);
    
    	}
    }
}
