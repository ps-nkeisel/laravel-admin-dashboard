<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInooptchildmatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inooptchildmatch', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('version')->nullable()->default(0)->index();
            $table->unsignedInteger('inoculation_id')->nullable()->default(0)->index();
            $table->unsignedInteger('inooptionchild_id')->nullable()->default(0)->index();

            $table->boolean('active')->nullable()->default(0);

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
        Schema::dropIfExists('inooptchildmatch');
    }
}
