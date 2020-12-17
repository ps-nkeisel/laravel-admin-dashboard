<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('assignto')->nullable()->default(0)->index();
            $table->unsignedInteger('idversionbefore')->nullable()->default(0);
            $table->unsignedInteger('idversionnext')->nullable()->default(0);
            $table->unsignedInteger('version')->nullable()->index()->default(0);
            $table->unsignedInteger('idcountry')->nullable()->index()->default(0);
            $table->unsignedInteger('idvisa')->nullable()->index()->default(0);
            $table->unsignedInteger('idcondition')->nullable()->index()->default(0);
            $table->unsignedInteger('idinnoculation')->nullable()->index()->default(0);
            $table->unsignedInteger('idtransitvisa')->nullable()->index()->default(0);
            $table->string('linkresource', 2000)->nullable();
            $table->unsignedInteger('created_user')->nullable()->index()->default(0);
            $table->ipAddress('created_ip')->nullable();
            $table->unsignedInteger('updated_user')->nullable()->index()->default(0);
            $table->ipAddress('updated_ip')->nullable();
            $table->boolean('archive')->nullable()->default(0);
            $table->boolean('active')->nullable()->default(0)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
