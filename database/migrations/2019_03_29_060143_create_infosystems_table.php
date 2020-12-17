<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfosystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infosystems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable()->index()->unique();
            $table->unsignedInteger('position')->unsigned()->nullable()->default(0)->index();
            $table->unsignedInteger('appearance')->unsigned()->nullable()->default(0);
            $table->unsignedInteger('lang')->unsigned()->nullable()->default(1)->index();
            $table->unsignedInteger('tagtype')->unsigned()->nullable()->index();
            $table->string('tagtext', 40)->nullable();
            $table->date('tagdate')->nullable();
            $table->string('header', 100)->nullable();
            $table->string('content', 1000)->nullable();
            $table->dateTime('controlled_at')->nullable();
            $table->unsignedInteger('controlled_user')->unsigned()->nullable()->index();
            $table->ipAddress('controlled_ip', 11)->nullable();
            $table->unsignedInteger('created_user')->unsigned()->nullable()->index();
            $table->ipAddress('created_ip', 20)->nullable();
            $table->unsignedInteger('updated_user')->unsigned()->nullable()->index();
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
        Schema::dropIfExists('infosystems');
    }
}
