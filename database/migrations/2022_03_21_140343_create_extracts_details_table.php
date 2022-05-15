<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtractsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extracts_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_extract');
            $table->unsignedBigInteger('id_investment');
            $table->string('monthly_profitability_percentage');
            $table->string('month',4);
            $table->date('profitability_start_date')->nullable(true);
            $table->tinyinteger('profitability_days')->nullable(true);
            $table->double('investment_amount',20,2);
            $table->double('real_profitability_percentage',4,2);
            $table->double('investment_return',20,2);
            $table->tinyinteger('status')->default(1)->nullable(true);
            
            
            $table->timestamps();

            $table->foreign('id_extract')->references('id')->on('extracts');
            $table->foreign('id_investment')->references('id')->on('investments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extracts_details');
    }
}
