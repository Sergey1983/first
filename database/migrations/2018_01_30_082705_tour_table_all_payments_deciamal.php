<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TourTableAllPaymentsDeciamal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {

            $table->decimal('price', 10, 2)->nullable()->change();
            $table->decimal('price_rub', 10, 2)->change();
            $table->decimal('first_payment', 10, 2)->nullable()->change();
            $table->decimal('operator_price', 10, 2)->nullable()->change();
            $table->decimal('operator_price_rub', 10, 2)->nullable()->change();
            });

        Schema::table('previous_tours', function (Blueprint $table) {

            $table->decimal('price', 10, 2)->nullable()->change();
            $table->decimal('price_rub', 10, 2)->change();
            $table->decimal('first_payment', 10, 2)->nullable()->change();
            $table->decimal('operator_price', 10, 2)->nullable()->change();
            $table->decimal('operator_price_rub', 10, 2)->nullable()->change();
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
