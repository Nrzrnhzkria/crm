<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_id');
            $table->string('ticket_type');
            $table->string('ic');          
            $table->string('pay_price');         
            $table->string('upgrade_count');     
            $table->string('pay_method');       
            $table->string('status');        
            $table->string('stripe_id');          
            $table->string('billplz_id');         
            $table->string('email_status');          
            $table->string('stud_id');          
            $table->string('product_id');
            $table->string('package_id');
            $table->string('payment_id');
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
        Schema::dropIfExists('ticket');
    }
}
