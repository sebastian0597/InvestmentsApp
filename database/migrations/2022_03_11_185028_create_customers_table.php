<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('phone', 10);
            $table->string('address');
            $table->string('city');
            $table->string('department');
            $table->string('country');
            $table->string('file_document');
            $table->string('description_ind')->nullable(true);
            $table->string('file_rut')->nullable(true);
            $table->string('business')->nullable(true);
            $table->string('position_business')->nullable(true);
            $table->string('antique_bussiness')->nullable(true);
            $table->string('type_contract')->nullable(true);
            $table->string('work_certificate')->nullable(true);
            $table->string('pension_fund')->nullable(true);
            $table->string('especification_other')->nullable(true);
            
            $table->string('account_number')->nullable(true);
            $table->string('account_type')->nullable(true);
            $table->string('bank_name')->nullable(true);
            $table->string('account_certificate')->nullable(true);

            $table->string('document_third')->nullable(true);
            $table->string('name_third')->nullable(true);
            $table->string('letter_authorization_third')->nullable(true);
            $table->string('kinship_third')->nullable(true);
            $table->string('rut_third')->nullable(true);
            

            $table->unsignedBigInteger('id_document_type');
            $table->unsignedBigInteger('id_economic_activity');
            $table->unsignedBigInteger('id_bank_account');
            $table->timestamps();

            $table->foreign('id_document_type')->references('id')->on('documents_types');
            $table->foreign('id_economic_activity')->references('id')->on('economics_activities');
            $table->foreign('id_bank_account')->references('id')->on('banks_account');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
