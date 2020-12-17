<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrypassassignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrypassassigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('entry_id')->nullable()->default(0)->index();
            $table->unsignedInteger('entrypassport_id')->nullable()->default(0)->index();

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
        Schema::dropIfExists('entrypassassigns');
    }
}
