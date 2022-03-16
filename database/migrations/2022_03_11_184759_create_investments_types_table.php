<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentsTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyinteger('status')->default(1)->nullable(true);  
            $table->tinyinteger('ind_generate_bank_note')->nullable(true); 
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
        Schema::dropIfExists('investments_types');
    }
}
