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
