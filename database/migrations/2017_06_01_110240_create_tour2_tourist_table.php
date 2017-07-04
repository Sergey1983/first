<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTour2TouristTable extends Migration
{

    public function up()
    {
        Schema::create('tour2_tourist', function (Blueprint $table) {

          $table->integer('tour2_id')->unsigned()->nullable();
          $table->foreign('tour2_id')->references('id')
            ->on('tour2s')->onDelete('cascade');
          
          $table->integer('tourist_id')->unsigned()->nullable();
          $table->foreign('tourist_id')->references('id')
            ->on('tourists')->onDelete('cascade');

          $table->integer('is_buyer')->unsigned()->nullable();
          $table->integer('is_tourist')->unsigned()->nullable();

          $table->timestamps();



        });
    }


    public function down()
    {
        Schema::dropIfExists('tour2_tourist');
    }
}
