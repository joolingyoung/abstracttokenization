<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Property extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('property');
        Schema::create('property', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userid')->nullable();
            $table->string('opportunity_name')->nullable();
            $table->string('opportunity_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('country')->nullable();
            $table->string('investor-full-name')->nullable();
            $table->string('investor-entity-name')->nullable();
            $table->string('ownership')->nullable();
            $table->string('investor-full-name-1')->nullable();
            $table->string('investor-entity-name-1')->nullable();
            $table->string('ownership-1')->nullable();
            $table->string('investor-full-name-2')->nullable();
            $table->string('investor-entity-name-2')->nullable();
            $table->string('ownership-2')->nullable();
            $table->text('captables')->nullable();
            $table->string('bankTransfer')->nullable();
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
        Schema::dropIfExists('property');
    }
}
