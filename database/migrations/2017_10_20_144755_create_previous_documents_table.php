<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreviousDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previous_documents', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tourist_id')->unsigned()->nullable();
            $table->foreign('tourist_id')->references('id')
            ->on('tourists')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');

            $table->integer('doc_id')->unsigned()->nullable();
            $table->foreign('doc_id')->references('id')
            ->on('documents')->onDelete('cascade');
            
            $table->integer('version')->unsigned();
            $table->string('doc_type');
            $table->string('doc_number');
            $table->integer('seria');


            $table->date('date_issue');
            $table->date('date_expire');

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
        Schema::dropIfExists('previous_documents');
    }
}
