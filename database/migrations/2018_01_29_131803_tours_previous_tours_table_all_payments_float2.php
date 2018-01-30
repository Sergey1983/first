<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ToursPreviousToursTableAllPaymentsFloat2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {

            $table->float('price')->nullable()->change();
            $table->float('price_rub')->change();
            $table->float('first_payment')->nullable()->change();
            $table->float('operator_price')->nullable()->change();
            $table->float('operator_price_rub')->nullable()->change();
            });

        Schema::table('previous_tours', function (Blueprint $table) {

            $table->float('price')->nullable()->change();
            $table->float('price_rub')->change();
            $table->float('first_payment')->nullable()->change();
            $table->float('operator_price')->nullable()->change();
            $table->float('operator_price_rub')->nullable()->change();
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
