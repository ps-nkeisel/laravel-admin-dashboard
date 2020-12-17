<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable()->index()->unique();
            $table->unsignedInteger('assignto')->nullable()->default(0)->index();
            $table->unsignedInteger('idversionbefore')->nullable()->default(0);
            $table->unsignedInteger('idversionnext')->nullable()->default(0);
            $table->unsignedInteger('version')->nullable()->default(0)->index();
            $table->string('code1', 40)->nullable()->index();
            $table->string('code2', 40)->nullable()->index();
            $table->string('code3', 40)->nullable()->index();
            $table->unsignedInteger('position')->nullable()->default(0)->index();
            $table->string('text1', 100)->nullable();
            $table->string('text2', 100)->nullable();
            $table->longText('content1')->nullable();
            $table->longText('content2')->nullable();
            $table->unsignedInteger('type')->nullable()->default(0);
            $table->unsignedInteger('category')->nullable()->default(0);
            $table->unsignedInteger('cluster')->nullable()->default(0);
            $table->unsignedInteger('tech')->nullable()->default(0);
            $table->unsignedInteger('client')->nullable()->default(0);
            $table->unsignedInteger('lang')->unsigned()->nullable()->default(1)->index();
            $table->string('nat', 2)->nullable()->index();
            $table->string('destco', 2)->nullable()->index();
            $table->date('validityfrom')->nullable();
            $table->date('validityto')->nullable();
            $table->dateTime('controlled_at')->nullable();
            $table->unsignedInteger('controlled_user')->nullable()->index();
            $table->ipAddress('controlled_ip', 11)->nullable();
            $table->unsignedInteger('created_user')->nullable()->index();
            $table->ipAddress('created_ip', 20)->nullable();
            $table->unsignedInteger('updated_user')->nullable()->index();
            $table->ipAddress('updated_ip', 20)->nullable();
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
        Schema::dropIfExists('contents');
    }
}
