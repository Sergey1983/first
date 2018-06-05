<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaymentsTouristsOperatorsTourIdOnchange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments_to_operators', function (Blueprint $table) {

             $table->dropForeign('payments_to_operators_tour_id_foreign');
             $table->foreign('tour_id')->references('id')
            ->on('tours')->onDelete('cascade')->onUpdate('cascade')->change();

            });

        Schema::table('payments_from_tourists', function (Blueprint $table) {
            $table->dropForeign('payments_from_tourists_tour_id_foreign');
             $table->foreign('tour_id')->references('id')
            ->on('tours')->onDelete('cascade')->onUpdate('cascade')->change();

            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
