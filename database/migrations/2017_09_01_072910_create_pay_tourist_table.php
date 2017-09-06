<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayTouristTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('payments_from_tourists', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('tour_id')->unsigned()->nullable();
            $table->foreign('tour_id')->references('id')
            ->on('tours')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');


            $table->integer('pay')->nullable();
            $table->integer('pay_rub');


            $table->softDeletes();
            $table->integer('deleted_by')->nullable();



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
        Schema::dropIfExists('payments_from_tourists');
    }
}
