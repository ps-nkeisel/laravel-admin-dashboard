<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUseractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * type
         * 1 = added
         * 2 = changed
         *
         * assigntype
         * 1 = idvisa
         * 2 = idcondition
         * 3 = idinoculation
         * 4 = idtransitvisa
         * 5 = idtranslate
         * 6 = idcruisevisa
         * 7 = idmessage
         * 8 = idlettercode
         * 9 = idcontent
         * 10 = idcountry
         * 11 = idusers
         */
        Schema::create('useractions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('type')->nullable()->index()->default(0);
            $table->unsignedInteger('assigntype')->nullable()->index()->default(0);
            $table->unsignedInteger('assigntonew')->nullable()->index()->default(0);
            $table->unsignedInteger('assigntoold')->nullable()->index()->default(0);
            $table->unsignedInteger('lang')->nullable()->index()->default(0);
            $table->unsignedInteger('version')->nullable()->index()->default(0);
            $table->unsignedInteger('destination')->nullable()->index()->default(0);
            $table->string('code', 20)->nullable()->default('');
            $table->string('comment', 192)->nullable();
            $table->unsignedInteger('created_user')->nullable()->index()->default(0);
            $table->ipAddress('created_ip')->nullable();
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
        Schema::dropIfExists('useractions');
    }
}
