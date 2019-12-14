<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Principles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('principles');
        Schema::create('principles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user')->nullable();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->text('bio')->nullable();
            $table->text('image')->nullable();
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
        Schema::dropIfExists('principles');
    }
}
