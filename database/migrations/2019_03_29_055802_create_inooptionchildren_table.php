<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInooptionchildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inooptionchildren', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('position')->unsigned()->nullable()->default(0)->index();
            $table->string('content', 150)->nullable();
            $table->string('contentcode', 5)->nullable();
            $table->dateTime('controlled_at')->nullable();
            $table->unsignedInteger('controlled_user')->nullable()->index();
            $table->ipAddress('controlled_ip', 11)->nullable();
            $table->unsignedInteger('created_user')->nullable()->index();
            $table->ipAddress('created_ip', 20)->nullable();
            $table->unsignedInteger('updated_user')->nullable()->index();
            $table->ipAddress('updated_ip', 20)->nullable();
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
        Schema::dropIfExists('inooptionchildren');
    }
}
