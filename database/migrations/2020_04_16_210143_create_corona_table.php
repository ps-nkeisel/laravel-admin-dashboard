<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoronaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corona', function (Blueprint $table) {
            $table->increments('id');
            $table->string('countrycode', 2)->default('')->index();
            $table->string('kbr_de', 190)->nullable();
            $table->string('kbr_en', 190)->nullable();
            $table->string('kar_de', 190)->nullable();
            $table->string('kar_en', 190)->nullable();
            $table->string('ever_de', 190)->nullable();
            $table->string('ever_en', 190)->nullable();
            $table->string('ebn_de', 190)->nullable();
            $table->string('ebn_en', 190)->nullable();
            $table->string('ge_de', 190)->nullable();
            $table->string('ge_en', 190)->nullable();
            $table->string('kes_de', 190)->nullable();
            $table->string('kes_en', 190)->nullable();
            $table->string('slu_de', 190)->nullable();
            $table->string('slu_en', 190)->nullable();
            $table->string('sla_de', 190)->nullable();
            $table->string('sla_en', 190)->nullable();
            $table->string('sse_de', 190)->nullable();
            $table->string('sse_en', 190)->nullable();
            $table->string('gla_de', 190)->nullable();
            $table->string('gla_en', 190)->nullable();
            $table->string('fla_de', 190)->nullable();
            $table->string('fla_en', 190)->nullable();
            $table->string('not_de', 190)->nullable();
            $table->string('not_en', 190)->nullable();
            $table->string('eol_de', 190)->nullable();
            $table->string('eol_en', 190)->nullable();
            $table->string('vre_de', 190)->nullable();
            $table->string('vre_en', 190)->nullable();
            $table->dateTime('controlled_at')->nullable();
            $table->unsignedInteger('controlled_user')->nullable()->index();
            $table->ipAddress('controlled_ip', 11)->nullable();
            $table->unsignedInteger('created_user')->nullable()->index();
            $table->ipAddress('created_ip', 20)->nullable();
            $table->unsignedInteger('updated_user')->nullable()->index();
            $table->ipAddress('updated_ip', 20)->nullable();
            $table->boolean('archive')->nullable()->default(0);
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
        Schema::dropIfExists('corona');
    }
}
