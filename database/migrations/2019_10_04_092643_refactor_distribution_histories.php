<?php

use App\DistributionHistory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorDistributionHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('distribution_history', function (Blueprint $table) {
            $table->renameColumn('investor_id', 'user_id');
            $table->renameColumn('distribution', 'amount');
            $table->timestamps();
            $table->dropColumn('property_type');
            $table->dropColumn('property_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distribution_history', function (Blueprint $table) {
            //
            $table->renameColumn('user_id', 'investor_id');
            $table->renameColumn('amount', 'distribution');
            $table->dropTimestamps();
            $table->integer('property_id');
            $table->string('property_type');
        });
    }
}
