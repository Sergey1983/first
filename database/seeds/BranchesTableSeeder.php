<?php

use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

     	DB::table('branches')->insert([

      		[
      			'name' => 'Автоматики',
            	'details' => 'Турагентство «ВИСТА»
(ИП Иванов Евгений Владимирович)

Местонахождение: Оренбург, пр-д Автоматики 17/4

Почтовый адрес: Оренбург, пр-д Автоматики 17/4

ИНН 561011373181  р.сч . 00000000000000000

к.сч. 00000000000000000

БИК 00000000000000000

в Каком-то Банке

тел (3532) 935566, е-mail vistaorenburg@gmail.com',

	      		'created_at' => \Carbon\Carbon::now(),
	      		'updated_at' => \Carbon\Carbon::now(),
      		],

      		[
      			'name' => 'Пистолетики',
            	'details' => 'Турагентство «АИСТА» (ИП Иванов Евгений Владимирович)

Местонахождение: Оренбург, пр-д Пистолетики 17/4 

Почтовый адрес: Оренбург, пр-д Пистолетики 17/4 

ИНН 561011373181

р.сч . 00000000000000000

к.сч. 00000000000000000

БИК 00000000000000000
в Каком-то Банке

тел (3532) 935566, е-mail vistaorenburg@gmail.com',

	      		'created_at' => \Carbon\Carbon::now(),
	      		'updated_at' => \Carbon\Carbon::now(),
      		]
        		
        		]);




    }
}
