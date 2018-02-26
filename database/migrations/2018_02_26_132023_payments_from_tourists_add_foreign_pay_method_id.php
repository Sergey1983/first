<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaymentsFromTouristsAddForeignPayMethodId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments_from_tourists', function (Blueprint $table) {

            $table->foreign('pay_method_id')->references('id')
            ->on('pay_methods')->onDelete('cascade')->onUpdate('cascade');
            });    }

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
