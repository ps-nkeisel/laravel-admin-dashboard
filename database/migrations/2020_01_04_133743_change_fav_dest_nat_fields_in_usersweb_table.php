<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFavDestNatFieldsInUserswebTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usersweb', function (Blueprint $table) {
            $table->json('favdestination')->nullable()->change();
            $table->json('favnationality')->nullable()->change();
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
