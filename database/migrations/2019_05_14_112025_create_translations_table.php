<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 2);
            $table->string('namespace')->default('*');
            $table->string('group');
            $table->string('item');
            $table->string('text');
            $table->boolean('unstable')->default(false);
            $table->boolean('locked')->default(false);
            $table->timestamps();
            $table->foreign('code')->references('code')->on('languages');
            $table->unique(['code', 'namespace', 'group', 'item']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translations');
    }
}
