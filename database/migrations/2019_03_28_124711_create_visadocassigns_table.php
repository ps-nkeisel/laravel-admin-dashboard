<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisadocassignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visadocassigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('visa_id')->nullable()->default(0)->index();
            $table->unsignedInteger('visadocument_id')->nullable()->default(0)->index();

            $table->boolean('active')->nullable()->default(0)->index();

            $table->unsignedInteger('created_user')->nullable()->index();
            $table->ipAddress('created_ip', 20)->nullable();
            $table->boolean('archive')->nullable()->default(0);

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
        Schema::dropIfExists('visadocassigns');
    }
}
