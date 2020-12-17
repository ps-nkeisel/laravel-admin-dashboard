<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInoculationchildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inoculationchildren', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('assignto')->unsigned()->nullable()->default(0)->index();
            $table->unsignedInteger('lang')->unsigned()->nullable()->default(1)->index();
            $table->unsignedInteger('position')->unsigned()->nullable()->default(0)->index();
            $table->string('content', 150)->nullable();
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
        Schema::dropIfExists('inoculationchildren');
    }
}
