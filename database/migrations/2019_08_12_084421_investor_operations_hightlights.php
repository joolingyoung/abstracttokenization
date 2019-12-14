<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvestorOperationsHightlights extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('operation_highlights');
        Schema::create('operation_highlights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('report_id')->nullable();
            $table->integer('current_principal_balance')->nullable();
            $table->double('annual_interest_rate', 8, 5)->nullable();
            $table->string('maturity_date')->nullable();
            $table->double('tax_escrow', 15, 5)->nullable();
            $table->double('insuarance_escrow', 15, 5)->nullable();
            $table->double('replacement_reserve_escrow', 15, 5)->nullable();
            $table->double('total_lender_reserves', 15, 5)->nullable();
            $table->double('trust_reserve', 15, 5)->nullable();
            $table->double('total_dst_reserves', 15, 5)->nullable();
            $table->double('total_reserves', 15, 5)->nullable();
            $table->double('occupancy_rate', 8, 5)->nullable();
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
        Schema::dropIfExists('operation_highlights');
    }
}
