<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrevioustourTouristTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previous_tour_tourists', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tour_id')->unsigned()->nullable();
            $table->foreign('tour_id')->references('id')
            ->on('tours')->onDelete('cascade');

            $table->integer('tour_version')->unsigned()->nullable();


            $table->integer('tourist_id')->unsigned()->nullable();
            $table->foreign('tourist_id')->references('id')
            ->on('tourists')->onDelete('cascade');

            $table->integer('tourist_version')->unsigned()->nullable();

            $table->integer('doc0')->unsigned();
            $table->foreign('doc0')->references('id')
            ->on('documents')->onDelete('cascade');

            $table->integer('doc0_version')->unsigned()->nullable();

            $table->integer('doc1')->unsigned()->nullable();
            $table->foreign('doc1')->references('id')
            ->on('documents')->onDelete('cascade'); 

            $table->integer('doc1_version')->unsigned()->nullable();

            $table->integer('is_buyer')->unsigned()->nullable();
            $table->integer('is_tourist')->unsigned()->nullable();

            $table->integer('this_version')->unsigned()->nullable();
            $table->string('version_created');

            $table->integer('user_id')->unsigned()->nullable();;
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade');

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
        Schema::dropIfExists('previous_tour_tourists');
    }
}
