<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSomeFieldsInPassCruisevisaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fields = [
            'scname_fr',
            'scname_it',
            'scname_nl',
            'scname_pl',
            'scname_es',
            'scname_pt',
            'scname_be',
            'scname_ru',
            'scrcode',
            'scrcodeext',
            'scrname',
            'scrname_en',
            'scrname_fr',
            'scrname_it',
            'scrname_nl',
            'scrname_pl',
            'scrname_es',
            'scrname_pt',
            'scrname_be',
            'scrname_ru',
            'countryfromcode',

            'routes',
            'countrypassport',
            'lettercodefrom',
            'lettercodeto',
            'passport',
            'temppassport',
            'identitycard',
            'tempidentitycard',
            'passportchild',
            'validity',
            'latestrequest',
            'travelwarning',
            'pregnant',
            'child',
            'immunisation',
            'required',
            'visa',
            'visa_en',
            'visa_fr',
            'visa_it',
            'visa_nl',
            'visa_pl',
            'visa_es',
            'visa_pt',
            'visa_be',
            'visa_ru',

            'longtext',
            'longtext_en',
            'longtext_fr',
            'longtext_it',
            'longtext_nl',
            'longtext_pl',
            'longtext_es',
            'longtext_pt',
            'longtext_be',
            'longtext_ru',

            'resourcechanged'
        ];

        foreach ($fields as $field) {
            if (Schema::hasColumn('pass_cruisevisa', $field)) {
                Schema::table('pass_cruisevisa', function (Blueprint $table) use ($field) {
                    $table->dropColumn($field);
                });
            }
        }
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
