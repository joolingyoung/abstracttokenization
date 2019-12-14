<?php

use App\Investment;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorInvestments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investments', function (Blueprint $table) {
            //
            $table->renameColumn('propertyid', 'property_id');
            $table->renameColumn('contributed', 'contributed_at');
            $table->renameColumn('investment_amount', 'amount');
            $table->boolean('is_sponsor')->default(false);
        });

        foreach (Investment::all() as $investment) {
            $investment->is_sponsor = $investment->sponsor == '1';
        }

        Schema::table('investments', function (Blueprint $table) {
            //
            $table->dropColumn('sponsor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investments', function (Blueprint $table) {
            //
            $table->renameColumn('property_id', 'propertyid');
            $table->renameColumn('amount', 'investment_amount');
            $table->renameColumn('contributed_at', 'contributed');
            $table->dropColumn('is_sponsor');
        });
    }
}
