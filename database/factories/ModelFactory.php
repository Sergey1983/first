<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */



use App\Airport as Airport;
use App\Services\Translit as Translit;




$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'patronymic' => 'Иванович',
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});



$factory->define(App\Tour::class, function(Faker\Generator $faker){



	return [

        'tour_type' => 'Пакетный',
        'branch_id' => $faker->numberBetween($min = 1, $max = 2),
     	  'city_from' => ($city_from = $faker->randomElement($array = array ('Оренбург','Москва Внуково', 'Минск', 'Актобе')) ),
        'city_return' => $city_from,
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
        'transfer' => $faker->randomElement($array = array ('Групповой', 'Индивидуальный', 'Нет')),
        'noexit_insurance_add_people' => ($noexitadd = $faker->randomElement($array = array (0, 1)) ), 
        'noexit_insurance' => $faker->randomElement($array = array ('Есть', 'Нет')),
        'noexit_insurance_people' => ($noexitadd === 0 ? null : 'Турист1, Турист 2'),
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
        'operator_full_pay' => null, 
        'operator_part_pay' => null, 
        'status' => $faker->randomElement($array = array ('Бронирование', 'Подтверждено', 'Отказ', 'Аннулировано')),



    		'created_at' => \Carbon\Carbon::createFromFormat('Y-m-d',  date("Y-m-d", mt_rand(12341234,1508925034))),
    		'updated_at' => \Carbon\Carbon::now(),

	];

});


$factory->define(App\Tourist::class, function (Faker\Generator $faker) {

    return [

    		'name' => ($name = $faker->firstName),
    		'lastName' => ($lastName = $faker->lastName),
        'patronymic' => 'Иванович',
      		'nameEng' => Translit::translit($name),
      		'lastNameEng' => Translit::translit($lastName),
			'birth_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
			'citizenship' => 'Россия',
            'gender' => 'Мужчина',
            'phone' => $faker->numberBetween($min = 1000000000, $max = 9999999999),
            'email' => $faker->email(),
    		'created_at' => \Carbon\Carbon::now(),
    		'updated_at' => \Carbon\Carbon::now(),
    ];
});



$factory->define(App\Document::class, function (Faker\Generator $faker) {

    return [

  
		      		// 'tourist_id' => $tourist_id,
		      		'user_id' => rand(1,3),
		      		'doc_type' => "Загран. паспорт", 
		      		'doc_number' => $faker->numberBetween($min = 1000000000, $max = 9999999999),
		      		'seria' => 2,
		      		'date_issue' => $faker->date($format = 'Y-m-d', $max = 'now'),
		      		'date_expire' => $faker->date($format = 'Y-m-d', $max = 'now'), 
		      		'created_at' => \Carbon\Carbon::now(),
		      		'updated_at' => \Carbon\Carbon::now(),



    ];
});






