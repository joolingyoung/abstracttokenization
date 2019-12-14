<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TrackDistributionHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribution_history', function(Blueprint $table) {
            $table->integer('property_id');
            $table->string('property_type');
            $table->integer('investor_id');
            $table->integer('distribution_id');
            $table->double('distribution', 15, 8);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('distribution_history');
    }
}
