<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Airport as Airport;
use App\previous_tour_tourist;

class ToursTableSeeder extends Seeder
{



    public function run()

    {


      factory(App\Tour::class, 1000)->create()->each(function($tour) {

        $tour->previous_tours()->create(array_merge(['version'=>1], $tour->toArray()) );


        $tourists = factory(App\Tourist::class, 4)->create();


        $tourists->each(function($tourist, $key) use ($tour) {




                $document = $tourist->documents()->save(factory(App\Document::class)->create());

                $tour->tourists()->attach($tourist, ['is_buyer'=> $is_buyer = $key == 0 ? 1 : 0, 'is_tourist'=>1, 'user_id'=>$user_id = rand(1,3), 'doc0'=>$document->id, 'doc1'=>null]);   


                $tourist->previous_versions_of_tourist()->create(array_merge(['version'=>1], $tourist->toArray()) );

                $document->previous_versions_of_document()->create(array_merge(['version'=>1], $document->toArray()) );




                previous_tour_tourist::create(['tour_id' => $tour->id, 'tour_version' => 1, 'tourist_id' => $tourist->id, 'tourist_version'=>1, 'doc0'=>$document->id, 'doc0_version'=>1, 'doc1'=>null, 'doc1_version'=>null, 'is_buyer'=>$is_buyer, 'is_tourist' => 1, 'this_version'=>1, 'version_created'=> \Carbon\Carbon::now(), 'user_id' => $user_id, 'created_at' => \Carbon\Carbon::now(), 'updated_at'=> \Carbon\Carbon::now()]);


                });




            });




       // factory(App\Tour::class, 100)->create()->each(function($tour) {


       //      $tour->tourists()->attach(


       //          factory(App\Tourist::class, 4)->create()->each(function($tourist) {


       //              $tourist->documents()->save(factory(App\Document::class)->create());

       //          }), ['is_buyer'=>0, 'is_tourist'=>1, 'user_id'=>rand(1,3), 'doc0'=>App\Tourist::all()->last()->documents->first()->id, 'doc1'=>null]

        
       //      );

       //  });


        // $tours = App\Tour::all();

        // $tourists = App\Tourist::all();

        // $tour_id = 1; 

        // $i = 0;

        // $tourists->each(function($tourist) use ($tours) {

        //     if($i > 0 ) {
            
        //     $tour_id = ($i % 4 === 0) ? $tour_id+1 : $tour_id;

        //     }

        //     $tourist->tours()->attach($tour_id, ['is_buyer'=>0, 'is_tourist'=>1, 'user_id'=>rand(1,3), 'doc0'=>$tourist->documents->first()->id, 'doc1'=>null]);

        //     ++$i;


        // });

        
        // factory(App\Tour::class, 100)->create()->each(function($tour) {

        //     factory(App\Tourist::class, 3)->make()->each(function($tourist) {

        //         $tourist->documents()->save(factory(App\Document::class)->save()

        //         factory(App\Document::class, 1)->make()->each(function($doc) use($tour, $tourist){

        //             $tour->tourists()->save($tourist, ['is_buyer'=>0, 'is_tourist'=>1, 'user_id'=>rand(1,3), 'doc0'=>, 'doc1'])

        //         });

        //     }); 

        // });


    	// $faker = Faker::create('ru_RU');

    	// for ($i=1; $i <=100; $i++) {

     //  	DB::table('tours')->insert([

     //  		'city_from' => ($city_from = $faker->randomElement($array = array ('Оренбург','Москва', 'Минск', 'Актобе')) ),
     //      'city_return' => $city_from,
     //      'user_id' => $faker->numberBetween($min = 1, $max = 3), 
     //      'country' => ($country = $faker->randomElement($array = array ('Таиланд', 'Турция', 'Россия', 'Абхазия')) ),
     //      'airport' => $faker->randomElement(Airport::where('country', $country)->get()->pluck('code')->toArray()), 
     //      'operator' => $faker->randomElement($array = array ('Алеан', 'Амиго-С', 'Анекс-Тур')),
     //      'nights' => $faker->numberBetween($min = 1, $max = 20), 
     //      'date_depart' => $faker->date($format = 'Y-m-d', $max = '2019-06-09'),
     //  		'hotel' => $faker->sentence($nbWords = 2, $variableNbWords = true),
     //      'room' => $faker->randomElement($array = array ('Дабл', 'Трипл', 'Квадрипл')),
     //      'add_rooms' => $faker->boolean(false),
     //      'food_type' => $faker->randomElement($array = array ('RO', 'BB')),
     //      'change_food_type' => $faker->boolean(false),
     //      'currency' => $faker->randomElement($array = array ('USD', 'RUB')),
     //      'price' => ($price = $faker->numberBetween($min = 1000, $max = 2000)), 
     //      'price_rub' => ($price_rub = $faker->numberBetween($min = 10000, $max = 50000)), 
     //      'is_credit' => $faker->boolean(false), 
     //      'transfer' => $faker->randomElement($array = array ('Групповой', 'Индивидуальный', 'Нет')),
     //      'noexit_insurance_add_people' => ($noexitadd = $faker->randomElement($array = array (0, 1)) ), 
     //      'noexit_insurance' => $faker->randomElement($array = array ('Есть', 'Нет')),
     //      'noexit_insurance_people' => ($noexitadd === 0 ? null : 'Турист1, Турист 2'),
     //      'med_insurance' => $faker->numberBetween($min = 0, $max = 1),
     //      'visa' => $faker->randomElement($array = array ('Есть', 'Нет')),
     //      'visa_add_people' => $faker->boolean(false),
     //      'visa_people' => null,
     //      'sightseeing' => 'Нет', 
     //      'change_sightseeing' => $faker->boolean(false),
     //      'extra_info' => null, 
     //      'first_payment' => null, 
     //      'bank' => null, 
     //      'source' => 'Онлайн-бронирование',
     //      'add_source' => false, 
     //      'operator_code' => 'ROUPUP10982374',
     //      'operator_price' => $price-100, 
     //      'operator_price_rub' => $price_rub-1000, 
     //      'operator_full_pay' => null, 
     //      'operator_part_pay' => null, 
     //      'status' => $faker->randomElement($array = array ('Бронирование', 'Подтверждено', 'Отказ', 'Аннулировано')),



     //  		'created_at' => \Carbon\Carbon::createFromFormat('Y-m-d',  date("Y-m-d", mt_rand(12341234,1508925034))),
     //  		'updated_at' => \Carbon\Carbon::now(),







     //    		]);
     //    }
    }
}