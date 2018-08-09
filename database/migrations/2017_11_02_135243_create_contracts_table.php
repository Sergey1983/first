<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tour_id')->unsigned()->nullable();
            $table->foreign('tour_id')->references('id')
            // ->on('tours')->onDelete('cascade');
            ->on('tours')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('doc_type');
            $table->integer('version_by_type');
            $table->integer('tour_version');
            

            $table->mediumText('text');
            $table->string('filename')->nullable()->unique();

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');




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
        Schema::dropIfExists('contracts');
    }
}
