<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export (1.5.0)
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateNationalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nationalities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_de', 150)->nullable();
            $table->string('name_en', 150)->nullable();
            $table->string('name_fr', 150)->nullable();
            $table->string('name_it', 150)->nullable();
            $table->string('name_nl', 150)->nullable();
            $table->string('name_pl', 150)->nullable();
            $table->string('name_es', 150)->nullable();
            $table->string('name_pt', 150)->nullable();
            $table->string('name_be', 150)->nullable();
            $table->string('name_ru', 150)->nullable();
            $table->string('code', 2)->nullable();
            $table->integer('prio')->nullable()->default(99);
            $table->dateTime('created_at')->nullable();
            $table->integer('created_user')->nullable();
            $table->string('created_ip', 20)->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_user')->nullable();
            $table->string('updated_ip', 20)->nullable();
            $table->tinyInteger('active')->nullable()->default(0);

            $table->index('code', 'countrycode');
            $table->index('prio', 'prio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nationalities');
    }
}
