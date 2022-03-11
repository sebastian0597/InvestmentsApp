<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer');
            $table->double('amount',20,2);
            $table->string('consignment_file');
            $table->unsignedBigInteger('id_currency');
            $table->string('other_currency');
            $table->unsignedBigInteger('id_payment_method');
            $table->date('investment_date');
            $table->tinyinteger('status')->default(1)->nullable(true);
            $table->timestamps();

            
            $table->foreign('id_customer')->references('id')->on('customers');
            $table->foreign('id_currency')->references('id')->on('currencies');
            $table->foreign('id_payment_method')->references('id')->on('payment_methods');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investments');
    }
}
