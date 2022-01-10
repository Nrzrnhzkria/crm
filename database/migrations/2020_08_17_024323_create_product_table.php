<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('name');
            $table->string('status');
            $table->string('date_from');
            $table->string('date_to');
            $table->string('time_from');
            $table->string('time_to');            
            $table->string('cert_image');      
            $table->string('offer_id');     
            $table->string('collection_id');     
            $table->string('survey_form');     
            $table->string('tq_page');
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
        Schema::dropIfExists('product');
    }
}
