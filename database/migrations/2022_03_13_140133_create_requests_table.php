<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer');
            $table->unsignedBigInteger('id_user_attends_request')->nullable(true);
            $table->timestamp('request_date')->nullable(true);
            $table->unsignedBigInteger('request_type');
            $table->text('description')->nullable(true);
            $table->tinyinteger('status')->default(1)->nullable(true);
            $table->text('answer')->nullable(true);
            $table->timestamp('answer_date')->nullable(true);

            $table->foreign('id_customer')->references('id')->on('customers');
            $table->foreign('id_user_attends_request')->references('id')->on('users');
            $table->foreign('request_type')->references('id')->on('request_types');
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
        Schema::dropIfExists('requests');
    }
}
