<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContentgroupIdFieldToContentadditionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contentadditionals', function (Blueprint $table) {
            $table->integer('contentgroup_id')->nullable()->default(0)->after('section_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contentadditionals', function (Blueprint $table) {
            //
        });
    }
}
