<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ToursPreviousToursTableAllPaymentsFloat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {

            $table->float('price', 8, 2)->nullable()->change();
            $table->float('price_rub', 8, 2)->change();
            $table->float('first_payment', 8, 2)->nullable()->change();
            $table->float('operator_price', 8, 2)->nullable()->change();
            $table->float('operator_price_rub', 8, 2)->nullable()->change();
            });

        Schema::table('previous_tours', function (Blueprint $table) {

            $table->float('price', 8, 2)->nullable()->change();
            $table->float('price_rub', 8, 2)->change();
            $table->float('first_payment', 8, 2)->nullable()->change();
            $table->float('operator_price', 8, 2)->nullable()->change();
            $table->float('operator_price_rub', 8, 2)->nullable()->change();
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
