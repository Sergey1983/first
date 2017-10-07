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
            $table->string('nameEng');
            $table->string('lastNameEng');
            $table->string('birth_date');
            $table->string('citizenship');
            $table->string('gender');
            $table->string('phone');
            $table->string('email');
            // $table->biginteger('doc_fullnumber')->unique();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('tourists');
    }
}
