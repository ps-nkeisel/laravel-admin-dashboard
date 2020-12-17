<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentgroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contentgroups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('contentadditionalable_type');

            $table->string('section')->nullable();
            $table->string('content')->nullable();

            $table->unsignedInteger('created_user')->nullable()->index();
            $table->ipAddress('created_ip', 20)->nullable();
            $table->unsignedInteger('updated_user')->nullable()->index();
            $table->ipAddress('updated_ip', 20)->nullable();

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
        Schema::dropIfExists('contentgroups');
    }
}
