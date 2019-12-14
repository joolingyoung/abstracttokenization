<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SecurityFlowProperty extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('security_flow_property');
        Schema::create('security_flow_property', function (Blueprint $table) {
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
            $table->string('property')->nullable();
            $table->string('opportunity_type')->nullable();
            $table->string('opportunity_description')->nullable();
            $table->string('property_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->string('vacancy_rate')->nullable();
            $table->string('current_noi')->nullable();
            $table->string('annual_cash_flow')->nullable();
            $table->string('1031_exchange')->nullable();
            $table->string('market_value')->nullable();
            $table->string('square_footage')->nullable();
            $table->string('property_class')->nullable();
            $table->string('total_debt')->nullable();
            $table->string('payoff_date')->nullable();
            $table->string('loan-type')->nullable();
            $table->string('developed')->nullable();
            $table->text('captables')->nullable();
            $table->string('pro-frorma-noi')->nullable();
            $table->string('distribution-frequency')->nullable();
            $table->string('equity-raise-floor-amount')->nullable();
            $table->string('total-capital-required')->nullable();
            $table->string('equity-raise-hard-cap')->nullable();
            $table->string('preferred-equity')->nullable();
            $table->string('common-equity')->nullable();
            $table->string('mezzanine-debt')->nullable();
            $table->string('senior-debt')->nullable();
            $table->text('principles')->nullable();
            $table->string('key-points')->nullable();
            $table->string('status')->default('Pending');
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
        Schema::dropIfExists('security_flow_property');
    }
}
