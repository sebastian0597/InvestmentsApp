<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeaturesToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_rol');
            $table->tinyinteger('status')->default(1)->nullable(true);
            $table->tinyinteger('ind_blocked')->nullable(true);
            $table->tinyinteger('time_blocked')->nullable(true);
            $table->tinyinteger('ind_banned')->nullable(true);
            $table->tinyinteger('failed_login_attempts')->nullable(true);
            $table->timestamp('blocked_date')->nullable(true);
            $table->timestamp('banned_date')->nullable(true);
            $table->string('personal_code')->unique();
            $table->foreign('id_rol')->references('id')->on('roles');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
