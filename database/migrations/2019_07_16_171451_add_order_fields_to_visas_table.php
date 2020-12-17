<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderFieldsToVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visas', function (Blueprint $table) {
            $table->boolean('noorderinformation')->nullable()->default(0)->after('foreignrepresentation');
            $table->float('online_handlingtime_to', 4,0)->nullable()->default(0)->after('handlingtime_online');
            $table->float('foreign_handlingtime_to', 4,0)->nullable()->default(0)->after('handlingtime_foreign');
            $table->boolean('online_viewweeks')->nullable()->default(0)->after('handlingtime_online');
            $table->boolean('foreign_viewweeks')->nullable()->default(0)->after('handlingtime_foreign');
            $table->renameColumn('handlingtime_online', 'online_handlingtime_from');
            $table->renameColumn('handlingtime_foreign', 'foreign_handlingtime_from');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visas', function (Blueprint $table) {
            //
        });
    }
}
