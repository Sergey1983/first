<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PreviousVersionsTour2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previousversionstour2s', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tour2_id')->unsigned();
            $table->foreign('tour2_id')->references('id')->on('tour2s');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('version')->unsigned();
            $table->string('сity_from');
            $table->string('hotel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('previousversionstour2s');

    }
}
