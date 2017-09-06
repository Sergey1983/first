<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourTouristTable extends Migration
{

    public function up()
    {
        Schema::create('tour_tourist', function (Blueprint $table) {

          $table->integer('tour_id')->unsigned()->nullable();
          $table->foreign('tour_id')->references('id')
            ->on('tours')->onDelete('cascade');
          
          $table->integer('tourist_id')->unsigned()->nullable();
          $table->foreign('tourist_id')->references('id')
            ->on('tourists')->onDelete('cascade');

          $table->integer('is_buyer')->unsigned()->nullable();
          $table->integer('is_tourist')->unsigned()->nullable();

          $table->integer('user_id')->unsigned()->nullable();
          $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');

          $table->timestamps();



        });
    }


    public function down()
    {
        Schema::dropIfExists('tour_tourist');
    }
}
