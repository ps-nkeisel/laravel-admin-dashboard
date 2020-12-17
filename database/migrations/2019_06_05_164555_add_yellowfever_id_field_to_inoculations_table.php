<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYellowfeverIdFieldToInoculationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inoculations', function (Blueprint $table) {
            $table->unsignedInteger('yellowfever_id')->nullable()->default(0)->index()->after('yf');
            $table->unsignedInteger('ggmonth')->nullable()->default(0)->after('yellowfever_id');
            $table->boolean('transitingeneral')->nullable()->default(0)->after('ggmonth');
            $table->boolean('transittime12hours')->nullable()->default(0)->after('transitingeneral');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inoculations', function (Blueprint $table) {
        });
    }
}
