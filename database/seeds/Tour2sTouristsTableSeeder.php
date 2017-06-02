<?php

use Illuminate\Database\Seeder;

class Tour2sTouristsTableSeeder extends Seeder
{

	    public function run()

	    {
	       $count=1;
	       $tour2_id=1;
	        
	        for ($i=1; $i <=40; $i++) {


		      	

		      	DB::table('tour2_tourist')->insert([

		      		'tour2_id' => $tour2_id,
		      		'tourist_id' => $i,
		      		'created_at' => \Carbon\Carbon::now(),
		      		'updated_at' => \Carbon\Carbon::now(),


		    		]);

		      	$count++;

		      	if ($count >4) {$tour2_id++; $count=1;}



	    }
	}
}