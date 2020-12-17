<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInoculationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inoculations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable()->index()->unique();
            $table->unsignedInteger('assignto')->nullable()->default(0)->index();
            $table->unsignedInteger('idversionbefore')->nullable()->default(0);
            $table->unsignedInteger('idversionnext')->nullable()->default(0);
            $table->unsignedInteger('version')->nullable()->default(0)->index();

            $table->boolean('active')->nullable()->default(0)->index();
            $table->boolean('importantchange')->nullable()->default(0)->index();
            $table->boolean('checkedandok')->nullable()->default(0)->index();
            $table->boolean('checkedandnotok')->nullable()->default(0)->index();

            $table->string('countrytocode', 2)->nullable()->index();
            $table->unsignedInteger('country_id')->nullable()->index();

            $table->boolean('pregnant')->nullable()->default(0);
            $table->boolean('child')->nullable()->default(0);
            $table->boolean('yellowfever')->nullable()->default(0);

            $table->string('linkresource', 1000)->nullable();
            $table->string('textresource', 1000)->nullable();

            $table->dateTime('controlled_at')->nullable();
            $table->unsignedInteger('controlled_user')->nullable()->index();
            $table->ipAddress('controlled_ip', 11)->nullable();
            $table->unsignedInteger('created_user')->nullable()->index();
            $table->ipAddress('created_ip', 20)->nullable();
            $table->unsignedInteger('updated_user')->nullable()->index();
            $table->ipAddress('updated_ip', 20)->nullable();
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
        Schema::dropIfExists('inoculations');
    }
}
