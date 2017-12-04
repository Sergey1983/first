<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTouristsTable extends Migration
{

    public function up()
    {
        Schema::create('tourists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastName');
            $table->string('patronymic')->nullable();
            $table->integer('cancel_patronymic')->default(0);
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


    public function down()
    {
        Schema::dropIfExists('tourists');
    }
}
