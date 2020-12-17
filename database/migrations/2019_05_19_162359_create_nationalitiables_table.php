<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNationalitiablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nationalitiables', function (Blueprint $table) {
            $table->unsignedInteger('nationality_id')->index();
            $table->unsignedInteger('nationalitiable_id')->index();
            $table->string('nationalitiable_type', 150);

            $table->unsignedInteger('created_user')->nullable()->index();
            $table->ipAddress('created_ip')->nullable();
            $table->boolean('archive')->nullable()->default(0)->index();
            $table->boolean('active')->nullable()->default(0)->index();
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
        Schema::dropIfExists('nationalitiables');
    }
}
