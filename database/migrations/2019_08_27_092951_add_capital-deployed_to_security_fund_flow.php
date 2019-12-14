<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCapitalDeployedToSecurityFundFlow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('security_fund_flow', function (Blueprint $table) {
            $table->string('capital-deployed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('security_fund_flow', function (Blueprint $table) {
            $table->dropColumn('capital-deployed');
        });
    }
}
