<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTour2sTable extends Migration
{

    public function up()
    {
        Schema::create('tour2s', function (Blueprint $table) {
            $table->increments('id');
            $table->string('сity_from');
            $table->string('hotel');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('tour2_tourist');
        Schema::dropIfExists('tour2s');
    }
}
