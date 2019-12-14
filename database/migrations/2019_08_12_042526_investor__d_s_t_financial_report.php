<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvestorDSTFinancialReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('dst_report');
        Schema::create('dst_report', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('report_id')->nullable();
            $table->double('base_rent_current', 15, 5)->nullable();
            $table->double('base_rent_ytd',15, 5)->nullable();
            $table->integer('annual_rent_current')->nullable();
            $table->integer('annual_rent_ytd')->nullable();
            $table->double('percentage_rent_current', 15, 5)->nullable();            
            $table->double('percentage_rent_ytd', 15, 5)->nullable();
            $table->double('total_rental_income_current', 15, 5)->nullable();
            $table->double('total_rental_income_ytd', 15, 5)->nullable();
            $table->integer('interest_expense_current')->nullable();
            $table->integer('interest_expense_ytd')->nullable();
            $table->integer('real_estate_taxes_current')->nullable();
            $table->integer('real_estate_taxes_ytd')->nullable();
            $table->integer('insurance_current')->nullable();
            $table->integer('insurance_ytd')->nullable();
            $table->integer('lender_reserves_current')->nullable();
            $table->integer('lender_reserves_ytd')->nullable();
            $table->double('signatory_trustee_fee_current', 15, 5)->nullable();
            $table->double('signatory_trustee_fee_ytd', 15, 5)->nullable();
            $table->integer('independent_trustee_fee_current');
            $table->integer('independent_trustee_fee_ytd');
            $table->double('total_expenses_current', 15, 5)->nullable();
            $table->double('total_expenses_ytd', 15, 5)->nullable();
            $table->double('net_income_before_depr', 15, 5)->nullable();
            $table->double('net_income_before_amort', 15, 5)->nullable();
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
        Schema::dropIfExists('dst_report');
    }
}
