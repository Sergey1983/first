<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Airport as Airport;

class ToursTableSeeder extends Seeder
{

    public function run()

    {
        

    	$faker = Faker::create('ru_RU');

    	for ($i=1; $i <=100; $i++) {

      	DB::table('tours')->insert([

      		'city_from' => $faker->randomElement($array = array ('Оренбург','Москва', 'Минск', 'Актобе')),
          'user_id' => $faker->numberBetween($min = 1, $max = 3), 
          'country' => ($country = $faker->randomElement($array = array ('Таиланд', 'Турция', 'Россия', 'Абхазия')) ),
          'airport' => $faker->randomElement(Airport::where('country', $country)->get()->pluck('code')->toArray()), 
          'operator' => $faker->randomElement($array = array ('Алеан', 'Амиго-С', 'Анекс-Тур')),
          'nights' => $faker->numberBetween($min = 1, $max = 20), 
          'date_depart' => $faker->date($format = 'Y-m-d', $max = '2019-06-09'),
      		'hotel' => $faker->sentence($nbWords = 2, $variableNbWords = true),
          'room' => $faker->randomElement($array = array ('Дабл', 'Трипл', 'Квадрипл')),
          'add_rooms' => $faker->boolean(false),
          'food_type' => $faker->randomElement($array = array ('RO', 'BB')),
          'change_food_type' => $faker->boolean(false),
          'currency' => $faker->randomElement($array = array ('USD', 'RUB')),
          'price' => ($price = $faker->numberBetween($min = 1000, $max = 2000)), 
          'price_rub' => ($price_rub = $faker->numberBetween($min = 10000, $max = 50000)), 
          'is_credit' => $faker->boolean(false), 
          'transfer' => $faker->randomElement($array = array ('Групповой', 'Нет')),
          'noexit_insurance_add_people' => $faker->boolean(false), 
          'noexit_insurance' => $faker->randomElement($array = array ('Есть', 'Нет')),
          'noexit_insurance_people' => null,
          'med_insurance' => $faker->numberBetween($min = 0, $max = 1),
          'visa' => $faker->randomElement($array = array ('Есть', 'Нет')),
          'visa_add_people' => $faker->boolean(false),
          'visa_people' => null,
          'sightseeing' => 'Нет', 
          'change_sightseeing' => $faker->boolean(false),
          'extra_info' => null, 
          'first_payment' => null, 
          'bank' => null, 
          'source' => 'Онлайн-бронирование',
          'add_source' => false, 
          'operator_code' => 'ROUPUP10982374',
          'operator_price' => $price-100, 
          'operator_price_rub' => $price_rub-1000, 
          'operator_payment' => null, 
          'operator_full_pay' => null, 
          'operator_part_pay' => null, 
          'status' => $faker->randomElement($array = array ('Бронирование', 'Подтверждено', 'Отказ', 'Аннулировано')),



      		'created_at' => \Carbon\Carbon::createFromFormat('Y-m-d',  date("Y-m-d", mt_rand(12341234,1508925034))),
      		'updated_at' => \Carbon\Carbon::now(),







        		]);
        }
    }
}