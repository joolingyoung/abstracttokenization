<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDistributionDates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'distributions', function(Blueprint $table) {
            $table->dropColumn('yield');
            $table->string('period_start_date');
            $table->string('period_end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->string('yield');
        $table->dropColumn('period_start_date');
        $table->dropColumn('period_end_date');
    }
}
