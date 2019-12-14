<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property', function (Blueprint $table) {
            //
            $table->dropColumn('investor-full-name');
            $table->dropColumn('investor-full-name-1');
            $table->dropColumn('investor-full-name-2');
            $table->dropColumn('investor-entity-name');
            $table->dropColumn('investor-entity-name-1');
            $table->dropColumn('investor-entity-name-2');
            $table->dropColumn('ownership');
            $table->dropColumn('ownership-1');
            $table->dropColumn('ownership-2');

            $table->bigInteger('cap_file_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property', function (Blueprint $table) {
            //
            $table->string('investor-full-name')->nullable();
            $table->string('investor-entity-name')->nullable();
            $table->string('ownership')->nullable();
            $table->string('investor-full-name-1')->nullable();
            $table->string('investor-entity-name-1')->nullable();
            $table->string('ownership-1')->nullable();
            $table->string('investor-full-name-2')->nullable();
            $table->string('investor-entity-name-2')->nullable();
            $table->string('ownership-2')->nullable();

            $table->dropColumn('cap_file_id');
        });
    }
}
