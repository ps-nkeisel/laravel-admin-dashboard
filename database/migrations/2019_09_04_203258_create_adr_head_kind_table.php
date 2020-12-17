<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdrHeadKindTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adr_head_kind', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('content_de', 45)->nullable();
            $table->string('content_en', 45)->nullable();

            $table->integer('created_user')->nullable();
            $table->string('created_ip', 20)->nullable();
            $table->integer('updated_user')->nullable();
            $table->string('updated_ip', 20)->nullable();
            $table->boolean('active')->nullable()->default(1)->index();
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
        Schema::dropIfExists('adr_head_kind');
    }
}
