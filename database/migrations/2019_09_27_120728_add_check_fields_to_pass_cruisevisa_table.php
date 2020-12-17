<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCheckFieldsToPassCruisevisaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pass_cruisevisa', function (Blueprint $table) {
            $table->boolean('importantchange')->nullable()->default(0)->index()->change();
            $table->boolean('checkedandok')->nullable()->default(0)->index()->after('importantchange');
            $table->boolean('checkedandnotok')->nullable()->default(0)->index()->after('importantchange');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pass_cruisevisa', function (Blueprint $table) {
            //
        });
    }
}
