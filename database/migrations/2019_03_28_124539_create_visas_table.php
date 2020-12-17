<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable()->index()->unique();
            $table->unsignedInteger('assignto')->nullable()->default(0)->index();
            $table->unsignedInteger('idversionbefore')->nullable()->default(0);
            $table->unsignedInteger('idversionnext')->nullable()->default(0);
            $table->unsignedInteger('version')->nullable()->index();

            $table->string('countrytocode', 2)->nullable()->index();
            $table->unsignedInteger('country_id')->nullable()->index();

            $table->boolean('active')->nullable()->default(0)->index();
            $table->boolean('importantchange')->nullable()->default(0)->index();
            $table->boolean('checkedandok')->nullable()->default(0)->index();
            $table->boolean('checkedandnotok')->nullable()->default(0)->index();

            $table->boolean('schengen')->nullable()->default(0);
            $table->boolean('require1')->nullable()->default(0);
            $table->boolean('require2')->nullable()->default(0);
            $table->boolean('require3')->nullable()->default(0);
            $table->boolean('supply1')->nullable()->default(0);
            $table->boolean('supply2')->nullable()->default(0);
            $table->boolean('supply3')->nullable()->default(0);
            $table->boolean('supply4')->nullable()->default(0);
            $table->unsignedInteger('resourcechanged')->nullable()->default(0);
            $table->unsignedInteger('status')->nullable()->default(0)->index();

            $table->string('linkresource', 1000)->nullable();
            $table->string('textresource', 1000)->nullable();
            $table->float('handlingtime', 4,0)->nullable()->default(0);

            $table->boolean('online')->nullable()->default(0);
            $table->boolean('onarrival')->nullable()->default(0);
            $table->boolean('foreignrepresentation')->nullable()->default(0);

            $table->boolean('free')->nullable()->default(0);
            $table->unsignedInteger('freedays')->nullable()->default(0);

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
        Schema::dropIfExists('visas');
    }
}
