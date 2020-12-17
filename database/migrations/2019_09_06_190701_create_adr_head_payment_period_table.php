<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export (1.5.0)
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateAdrHeadPaymentPeriodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adr_head_payment_period', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content_de', 45)->nullable();
            $table->string('content_en', 45)->nullable();
            $table->integer('created_user')->nullable();
            $table->string('created_ip', 20)->nullable();
            $table->integer('updated_user')->nullable();
            $table->string('updated_ip', 20)->nullable();
            $table->char('active', 1)->default('1');





        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adr_head_payment_period');
    }
}