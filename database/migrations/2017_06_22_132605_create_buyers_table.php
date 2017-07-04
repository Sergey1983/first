<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyers', function (Blueprint $table) {

            $table->integer('tour2_id')->unsigned()->nullable();
            $table->foreign('tour2_id')->references('id')
            ->on('tour2s')->onDelete('cascade');

            $table->integer('tourist_id')->unsigned()->nullable();
            $table->foreign('tourist_id')->references('id')
            ->on('tourists')->onDelete('cascade');



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
        Schema::dropIfExists('buyers');
    }
}
