<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMailableFieldToUserswebTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usersweb', function (Blueprint $table) {
            $table->boolean('mailable')->nullable()->default(0)->index()->after('poa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usersweb', function (Blueprint $table) {
            //
        });
    }
}
