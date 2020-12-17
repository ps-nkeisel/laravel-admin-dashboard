<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('user_id')->nullable()->default(0)->index();
            $table->string('type')->nullable();
            $table->string('message')->nullable();

            $table->integer('created_user')->nullable();
            $table->ipAddress('created_ip', 20)->nullable();
            $table->integer('updated_user')->nullable();
            $table->ipAddress('updated_ip', 20)->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
