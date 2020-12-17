<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrycontentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrycontents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('assignto')->nullable()->default(0)->index();
            $table->unsignedInteger('idversionbefore')->nullable()->default(0);
            $table->unsignedInteger('idversionnext')->nullable()->default(0);
            $table->unsignedInteger('version')->nullable()->default(0)->index();
            $table->unsignedInteger('lang')->nullable()->index();
            $table->longText('content1')->nullable();
            $table->dateTime('controlled_at')->nullable();
            $table->unsignedInteger('controlled_user')->nullable()->index();
            $table->ipAddress('controlled_ip', 11)->nullable();
            $table->unsignedInteger('created_user')->nullable()->index();
            $table->ipAddress('created_ip', 20)->nullable();
            $table->unsignedInteger('updated_user')->nullable()->index();
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
        Schema::dropIfExists('entrycontents');
    }
}
