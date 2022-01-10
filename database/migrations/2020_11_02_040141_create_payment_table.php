<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id');
            $table->string('pay_price');
            $table->string('totalprice');
            $table->string('quantity');
            $table->string('status');
            $table->integer('upgrade_count');
            $table->integer('update_count');
            $table->string('pay_method');
            $table->string('email_status');
            $table->string('stud_id');
            $table->string('product_id');
            $table->string('package_id');
            $table->string('offer_id');
            $table->string('membership_id');
            $table->string('level_id');
            $table->string('stripe_id');
            $table->string('billplz_id');
            $table->string('user_id');
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
        Schema::dropIfExists('payment');
    }
}
