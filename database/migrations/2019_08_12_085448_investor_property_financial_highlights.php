<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvestorPropertyFinancialHighlights extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('property_financial_highlights');
        Schema::create('property_financial_highlights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('report_id')->nullable();
            $table->integer('rental_income_current')->nullable();
            $table->integer('rental_income_ytd')->nullable();
            $table->integer('other_rental_income_current')->nullable();
            $table->integer('other_rental_income_ytd')->nullable();
            $table->integer('total_rental_income_current')->nullable();
            $table->integer('total_rental_income_ytd')->nullable();
            $table->integer('administrative_current')->nullable();
            $table->integer('administrative_ytd')->nullable();
            $table->integer('payroll_current')->nullable();
            $table->integer('payroll_ytd')->nullable();
            $table->integer('marketing_current')->nullable();
            $table->integer('marketing_ytd')->nullable();
            $table->integer('utilities_current')->nullable();
            $table->integer('utilities_ytd')->nullable();
            $table->integer('repairs_maintenance_current')->nullable();
            $table->integer('repairs_maintenance_ytd')->nullable();
            $table->integer('grounds_current')->nullable();
            $table->integer('grounds_ytd')->nullable();
            $table->integer('other_operating_current')->nullable();
            $table->integer('other_operating_ytd')->nullable();
            $table->integer('licenses_permits_current')->nullable();
            $table->integer('licenses_permits_ytd')->nullable();
            $table->integer('property_management_fees_current')->nullable();
            $table->integer('property_management_fees_ytd')->nullable();
            $table->integer('re_taxes_current')->nullable();
            $table->integer('re_taxes_ytd')->nullable();
            $table->integer('insurance_current')->nullable();
            $table->integer('insurance_ytd')->nullable();
            $table->integer('capital_activity_current')->nullable();
            $table->integer('capital_activity_ytd')->nullable();
            $table->integer('total_operating_costs_current')->nullable();
            $table->integer('total_operating_costs_ytd')->nullable();
            $table->integer('net_operating_income_current')->nullable();
            $table->integer('net_operating_income_ytd')->nullable();
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
        Schema::dropIfExists('property_financial_highlights');
    }
}
