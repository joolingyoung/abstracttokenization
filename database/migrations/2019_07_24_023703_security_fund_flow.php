<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SecurityFundFlow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('security_fund_flow');
        Schema::create('security_fund_flow', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userid')->nullable();
            $table->string('target-investor-irr')->nullable();
            $table->string('investment-profile')->nullable();
            $table->string('funds-due')->nullable();
            $table->string('target-equity-multiple')->nullable();
            $table->string('minimum-investment')->nullable();
            $table->string('distribution-period')->nullable();
            $table->string('target-investment-period')->nullable();
            $table->string('property-type')->nullable();
            $table->string('sponsor-co-investment')->nullable();
            $table->string('target-avg-investor-cash-yield')->nullable();
            $table->string('offers-due')->nullable();
            $table->string('distribution-commencement')->nullable();
            $table->string('fund-name')->nullable();
            $table->string('opportunity-type')->nullable();
            $table->string('type-of-fund')->nullable();
            $table->string('capital-origin')->nullable();
            $table->string('fund-address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->string('fund-description')->nullable();
            $table->text('captables')->nullable();
            $table->string('minimum-raise-amount')->nullable();
            $table->string('distribution-frequency')->nullable();
            $table->string('maximum-raise-amount')->nullable();
            $table->string('total-capital-required')->nullable();
            $table->string('preferred-equity')->nullable();
            $table->string('common-equity')->nullable();
            $table->string('mezzanine-debt')->nullable();
            $table->string('senior-debt')->nullable();
            $table->string('vacancy-rate')->nullable();
            $table->string('proforma-current-noi')->nullable();
            $table->string('annual-cash-flow')->nullable();
            $table->string('1031-exchange')->nullable();
            $table->string('market-value')->nullable();
            $table->string('square-footage')->nullable();
            $table->string('property-class')->nullable();
            $table->string('total-debt')->nullable();
            $table->string('payoff-date')->nullable();
            $table->string('loan-type')->nullable();
            $table->string('developed')->nullable();
            $table->string('existing-properties')->nullable();
            $table->text('principles')->nullable();
            $table->text('key-points')->nullable();
            $table->string('status')->default('Approved');
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
        Schema::dropIfExists('security_fund_flow');
    }
}
