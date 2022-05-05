<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReinvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reinvestments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer');
            $table->unsignedBigInteger('id_investment');
            $table->double('amount',20,2);
            $table->unsignedBigInteger('id_investment_type');
            $table->date('reinvestment_date');
            $table->unsignedBigInteger('registered_by');
            $table->unsignedBigInteger('updated_by')->nullable(true);
            $table->tinyinteger('status')->default(1)->nullable(true);
            $table->timestamps();

            $table->foreign('id_customer')->references('id')->on('customers');         
            $table->foreign('id_investment_type')->references('id')->on('investments_types');
            $table->foreign('registered_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reinvestments');
    }
}
