<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PreviousTourist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previous_tourists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tourist_id')->unsigned();
            $table->foreign('tourist_id')->references('id')->on('tourists')->onDelete('cascade');
            $table->integer('version')->unsigned();
            $table->string('name');
            $table->string('lastName');
            $table->string('nameEng');
            $table->string('lastNameEng');
            $table->string('birth_date');
            $table->string('citizenship');
            $table->string('gender');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('previous_tourists');

    }
}
