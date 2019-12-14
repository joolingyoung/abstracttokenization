<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WireDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('investments');
        Schema::create( 'investments', function( Blueprint $table ) {
            $table->bigIncrements('id');
            $table->integer('userid');
            $table->integer('propertyid');
            $table->integer('investment_amount');
            $table->date('contributed');
            $table->string('entity_name')->nullable();
            $table->double('share', 15, 8);
            $table->string('type');
            $table->string('routing_number')->nullable();
            $table->string('account_number')->nullable();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investments');
    }
}
