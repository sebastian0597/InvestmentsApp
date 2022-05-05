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
            //$table->unsignedBigInteger('id_currency');
            $table->string('code_currency');
            $table->double('base_amount',20,2);
            $table->double('initial_amount',20,2);
            $table->double('amount',20,2);
            $table->double('amount_disbursement',20,2)->nullable(true);
            $table->string('consignment_file')->nullable(true);
            
            $table->string('other_currency')->nullable(true);
            $table->double('percentage_investment')->nullable(true);
            $table->unsignedBigInteger('id_payment_method');
            $table->unsignedBigInteger('id_investment_type');
            $table->date('investment_date');
            $table->date('profitability_start_date')->nullable(true);
            $table->unsignedBigInteger('registered_by');
            $table->unsignedBigInteger('updated_by')->nullable(true);
            $table->tinyinteger('status')->default(1)->nullable(true);
            $table->timestamps();

            
            $table->foreign('id_customer')->references('id')->on('customers');
            //$table->foreign('id_currency')->references('id')->on('currencies');
            $table->foreign('id_payment_method')->references('id')->on('payment_methods');
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
        Schema::dropIfExists('investments');
    }
}
