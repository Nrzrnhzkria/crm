<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment', function (Blueprint $table) {
            $table->string('cheque_no');
            $table->string('bankname');
            $table->string('date_payment');
            $table->string('chequeimage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment', function (Blueprint $table) {
            $table->dropColumn('cheque_no');
            $table->dropColumn('bankname');
            $table->dropColumn('date_payment');
            $table->dropColumn('chequeimage');
        });
    }
}
