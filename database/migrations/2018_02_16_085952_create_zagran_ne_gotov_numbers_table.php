<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZagranNeGotovNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    
    {
        Schema::create('zagran_ne_gotov_numbers', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('number')->unsigned();
            // $table->foreign('number')->references('id')
            // ->on('documents')->onDelete('cascade')->onUpdate('cascade');
            
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
        Schema::dropIfExists('zagran_ne_gotov_numbers');
    }
}
