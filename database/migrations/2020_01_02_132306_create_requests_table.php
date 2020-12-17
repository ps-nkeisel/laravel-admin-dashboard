<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userid')->nullable()->default(0)->index();
            $table->string('requestid', 50)->nullable()->default(0)->index();
            $table->string('dest', 2)->nullable()->default(0)->index();
            $table->string('nat', 2)->nullable()->default(0)->index();
            $table->string('lang', 2)->nullable()->default(0)->index();
            $table->string('bookingnr', 20)->nullable()->default(0)->index();
            $table->string('traveldate', 10)->nullable()->default(0)->index();
            $table->boolean('checkimportant')->nullable()->default(0)->index();
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
        Schema::dropIfExists('requests');
    }
}
