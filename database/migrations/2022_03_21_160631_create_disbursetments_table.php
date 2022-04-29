<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisbursetmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disbursetments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer');
            $table->unsignedBigInteger('id_disbursement_type');
            $table->double('value_consign',20,2);
            $table->string('disbursetment_file')->nullable(true);
            $table->string('month',4);
            $table->double('monthly_return',20,2);
            $table->tinyinteger('ind_done')->nullable(true);
            $table->timestamps();

            $table->foreign('id_customer')->references('id')->on('customers');
            $table->foreign('id_disbursement_type')->references('id')->on('disbursement_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disbursetments');
    }
}
