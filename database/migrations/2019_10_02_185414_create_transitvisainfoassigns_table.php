<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransitvisainfoassignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transitvisainfoassigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('transitvisa_id')->nullable()->default(0)->index();
            $table->unsignedInteger('transitvisainfo_id')->nullable()->default(0)->index();

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
        Schema::dropIfExists('transitvisainfoassigns');
    }
}
