<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      	DB::table('users')->insert([

      		[
      			'name' => 'Евгений',
            'last_name' => 'Иванов',
            'patronymic' => 'Иванович',
	      		'role_id' => 1, 
	      		'email' => 'e@m.ru',
            'branch_id' => 1,
            'permission' => 1,
	      		'password' => bcrypt('test'),
	      		'created_at' => \Carbon\Carbon::now(),
	      		'updated_at' => \Carbon\Carbon::now(),
      		],

      		[
      			'name' => 'Маша',
            'last_name' => 'Потапова',
            'patronymic' => 'Ивановна',
	      		'role_id' => 2, 
	      		'email' => 'm@m.ru',
            'branch_id' => 1,
	      		'password' => bcrypt('test'),
            'permission' => 0,
	      		'created_at' => \Carbon\Carbon::now(),
	      		'updated_at' => \Carbon\Carbon::now(),
      		],

      		[
      			'name' => 'Даша',
            'last_name' => 'Бородина',
            'patronymic' => 'Ивановна',
	      		'role_id' => 2, 
	      		'email' => 'd@m.ru',
            'branch_id' => 2,
            'permission' => 0,
	      		'password' => bcrypt('test'),
	      		'created_at' => \Carbon\Carbon::now(),
	      		'updated_at' => \Carbon\Carbon::now(),
      		]
        		
        		]);


    }
}
