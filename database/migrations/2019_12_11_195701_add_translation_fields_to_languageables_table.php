<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTranslationFieldsToLanguageablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('languageables', function (Blueprint $table) {
            $table->date('agencyexport')->nullable()->after('content');
            $table->date('agencytranslated')->nullable()->after('content');
            $table->date('agencyimport')->nullable()->after('content');
            $table->date('translated')->nullable()->after('content');
            $table->integer('translatedfrom')->nullable()->after('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('languageables', function (Blueprint $table) {
            //
        });
    }
}
