<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 2)->nullable()->default('de')->index();
            $table->unsignedInteger('position')->nullable()->default(0)->index();
            $table->string('language', 2)->nullable()->default('de')->index();
            $table->string('content', 40)->nullable()->default('deutsch')->index();
            $table->unsignedInteger('created_user')->nullable()->index()->default(0);
            $table->ipAddress('created_ip')->nullable();
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
        Schema::dropIfExists('languages');
    }
}
