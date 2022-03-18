<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer');
            $table->double('total_disbursed',20,2);
            $table->double('total_reinvested',20,2);
            $table->double('profitability_percentage',20,2)->nullable(true);
            $table->double('grand_total_invested',20,2);
            
            $table->timestamps();

            $table->foreign('id_customer')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extracts');
    }
}
