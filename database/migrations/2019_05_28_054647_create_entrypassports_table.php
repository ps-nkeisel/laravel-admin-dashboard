<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrypassportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrypassports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('position')->nullable()->default(0)->index();
            $table->string('content', 100)->nullable();
            $table->string('contentcode', 10)->nullable()->index();
            $table->boolean('archive')->nullable()->default(0);
            $table->boolean('active')->nullable()->default(0);
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
        Schema::dropIfExists('entrypassports');
    }
}
