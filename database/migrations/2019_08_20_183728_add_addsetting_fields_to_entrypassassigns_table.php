<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddsettingFieldsToEntrypassassignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrypassassigns', function (Blueprint $table) {
            $table->integer('months_validity')->nullable()->default(0)->after('active');
            $table->string('period')->nullable()->after('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entrypassassigns', function (Blueprint $table) {
            //
        });
    }
}
