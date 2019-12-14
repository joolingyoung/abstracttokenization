<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvestorCashDistributionSummary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('cash_distribution_summary');
        Schema::create('cash_distribution_summary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('report_id')->nullable();
            $table->integer('cumulative_cash_distribution')->nullable();
            $table->double('cumulative_annualized', 6, 5)->nullable();
            $table->double('pre_tax_cumulative', 6, 5)->nullable();
            $table->integer('current_month_cash')->nullable();
            $table->double('current_month_annualized', 6, 5)->nullable();      
            $table->double('pre_tax_current_annualized', 6, 5)->nullable();
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
        Schema::dropIfExists('cash_distribution_summary');
    }
}
