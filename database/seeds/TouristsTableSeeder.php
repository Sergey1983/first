<?php

use Illuminate\Database\Seeder;
use App\Services\Translit;
use Faker\Factory as Faker;

class TouristsTableSeeder extends Seeder

{

    public function run()

    {
        $faker = Faker::create('ru_RU');


    	for ($i=1; $i <=40; $i++) {

    	DB::table('tourists')->insert([

    		'name' => ($a = $faker->firstName),
    		'lastName' => ($b = $faker->lastName),
      		'nameEng' => Translit::translit($a),
      		'lastNameEng' => Translit::translit($b),
			'birth_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
			// 'citizenship' => $faker->randomElement($array = array ('Россия','Беларусь','Украина')),
			// 'doc_type' => $faker->randomElement($array = array ('РФ загранпаспорт','РФ свидетельство о рождении','Другой документ')),
			// 'doc_number_ser'  => ($c = $faker->randomNumber($nbDigits = 4, $strict=true)),
			// 'doc_number_num' => ($d = $faker->randomNumber($nbDigits = 6, $strict=true)),
			// 'doc_starts' => $faker->date($format = 'd-m-Y', $max = 'now'),
			// 'doc_expires' => $faker->date($format = 'd-m-Y', $max = '+10 years'),
			// 'doc_fullnumber' => $c.''.$d,
            'doc_fullnumber' => $faker->randomNumber($nbDigits = 6, $strict=true),
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now(),


    		]);
    
    	}
    }
}
