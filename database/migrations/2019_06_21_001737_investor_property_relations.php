<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvestorPropertyRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Track investor <-> microsite relationships
        Schema::create( 'microsite_sponsors', function( Blueprint $table ) {
            $table->bigIncrements('id');
            $table->integer('sponsorid');
            $table->integer('siteid');
        } );

        // Track investor <-> property relationship
        Schema::create( 'investments', function( Blueprint $table ) {
            $table->bigIncrements('id');
            $table->integer('userid');
            $table->integer('propertyid');
            $table->integer('investment_amount');
            $table->date('contributed');
            $table->string('entity_name')->nullable();
            $table->double('share', 15, 8);
            $table->string('type');
        } );

        // Add invite code functionality for investors
        Schema::table( 'users', function( Blueprint $table) {
            $table->string('invite_code')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop( 'microsite_sponsors' );
        Schema::drop( 'investments' );
        Schema::table( 'users', function( Blueprint $table ) {
            $table->dropColumn('invite_code');
        });
    }
}
