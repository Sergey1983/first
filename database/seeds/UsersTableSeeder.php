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
	      		'role_id' => 1, 
	      		'email' => 'e@m.ru',
            'permission' => 1,
	      		'password' => bcrypt('test'),
	      		'created_at' => \Carbon\Carbon::now(),
	      		'updated_at' => \Carbon\Carbon::now(),
      		],

      		[
      			'name' => 'Маша',
	      		'role_id' => 2, 
	      		'email' => 'm@m.ru',
	      		'password' => bcrypt('test'),
            'permission' => 0,
	      		'created_at' => \Carbon\Carbon::now(),
	      		'updated_at' => \Carbon\Carbon::now(),
      		],

      		[
      			'name' => 'Даша',
	      		'role_id' => 2, 
	      		'email' => 'd@m.ru',
            'permission' => 0,
	      		'password' => bcrypt('test'),
	      		'created_at' => \Carbon\Carbon::now(),
	      		'updated_at' => \Carbon\Carbon::now(),
      		]
        		
        		]);


    }
}
