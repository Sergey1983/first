<?php

use Illuminate\Database\Seeder;

class Tour2sTouristsTableSeeder extends Seeder
{

	    public function run()

	    {
	       $count=1;
	       $tour2_id=1;
	       $is_buyer_index=1;
	        
	        for ($i=1; $i <=400; $i++) {


	        	if ($count == $is_buyer_index) 

	        		{$is_buyer=1; $is_tourist=rand(0,1);} 

	        		else {$is_buyer=0; $is_tourist=1;}
		      	

		      	DB::table('tour_tourist')->insert([

		      		'tour_id' => $tour2_id,
		      		'tourist_id' => $i,
		      		'doc0' => $i, 
		      		'doc1' => null,
		      		'is_buyer' => $is_buyer,
		      		'is_tourist' => $is_tourist, 
		      		'user_id' => rand(1,3), 
		      		'created_at' => \Carbon\Carbon::now(),
		      		'updated_at' => \Carbon\Carbon::now(),


		    		]);

		      	$count++;

		      	if ($count >4) {$tour2_id++; $count=1; $is_buyer_index = rand(1,4);}



	    }
	}
}