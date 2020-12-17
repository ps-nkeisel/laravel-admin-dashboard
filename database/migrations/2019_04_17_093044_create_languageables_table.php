<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languageables', function (Blueprint $table) {
            $table->unsignedInteger('language_id')->index();
            $table->unsignedInteger('languageable_id')->index();
            $table->string('languageable_type', 150);
            $table->string('content', 150)->nullable();
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
        Schema::dropIfExists('languageables');
    }
}
