<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TourTableAllPaymentsFloat2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {

            $table->float('price', 9, 2)->nullable()->change();
            $table->float('price_rub', 9, 2)->change();
            $table->float('first_payment', 9, 2)->nullable()->change();
            $table->float('operator_price', 9, 2)->nullable()->change();
            $table->float('operator_price_rub', 9, 2)->nullable()->change();
            });

        Schema::table('previous_tours', function (Blueprint $table) {

            $table->float('price', 9, 2)->nullable()->change();
            $table->float('price_rub', 9, 2)->change();
            $table->float('first_payment', 9, 2)->nullable()->change();
            $table->float('operator_price', 9, 2)->nullable()->change();
            $table->float('operator_price_rub', 9, 2)->nullable()->change();
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
