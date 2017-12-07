<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{

    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');

            $table->string('tour_type', 50);
            $table->string('city_from', 50);
            $table->boolean('city_return_add')->default(false);
            $table->string('city_return', 50)->nullable();
            $table->string('country', 50);
            $table->string('airport', 50);
            $table->string('operator', 250);
            $table->integer('nights');    
            $table->date('date_depart');
            $table->boolean('date_hotel')->default(false);      
            $table->string('hotel', 50);
            $table->string('room', 255);
            $table->boolean ('add_rooms')->default(false);
            $table->string('food_type', 255);
            $table->boolean('change_food_type')->default(false);
            $table->string('currency', 4);
            $table->integer('price')->nullable();
            $table->integer('price_rub');
            $table->boolean('is_credit')->default(false);;
            $table->string('transfer', 50);
            $table->string('noexit_insurance', 50);
            $table->boolean('noexit_insurance_add_people')->default(false);  ;
            $table->string('noexit_insurance_people', 255)->nullable();
            $table->integer('med_insurance');
            $table->string('visa', 50);
            $table->boolean('visa_add_people')->default(false);
            $table->string('visa_people', 255)->nullable();
            $table->string('sightseeing', 255)->nullable();
            $table->boolean('change_sightseeing')->default(false);
            $table->string('extra_info', 255)->nullable();
            $table->integer('first_payment')->nullable();
            $table->string('bank', 50)->nullable();
            $table->string('source', 50);
            $table->boolean ('add_source')->default(false);
            $table->string('operator_code', 50)->nullable();
            $table->integer('operator_price')->nullable();
            $table->integer('operator_price_rub')->nullable();
            $table->date('operator_full_pay')->nullable();
            $table->date('operator_part_pay')->nullable();
            $table->string('status', 50)->nullable();

            $table->timestamps();
        });
    }
    


    public function down()
    {


        // Schema::dropIfExists('tour_tourist');
        // Schema::dropIfExists('previous_tours');
        // Schema::dropIfExists('previous_tour_tourists');
        Schema::dropIfExists('tours');

    }
}
