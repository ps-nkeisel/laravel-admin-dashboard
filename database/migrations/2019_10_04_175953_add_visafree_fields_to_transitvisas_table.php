<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVisafreeFieldsToTransitvisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transitvisa', function (Blueprint $table) {
            $table->boolean('visa_free')->nullable()->default(0)->after('exception');
            $table->unsignedInteger('visa_freedays')->nullable()->default(0)->after('exception');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transitvisas', function (Blueprint $table) {
            //
        });
    }
}
