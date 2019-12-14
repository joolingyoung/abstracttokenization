<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustodyAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custody_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('user_id');
            $table->text('user_email');
            $table->text('account_id');
            $table->text('token_symbol');
            $table->integer('token_count')->default(0);
            $table->double('token_balance')->default(0);
            $table->double('total_budget')->default(0);
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
        Schema::dropIfExists('custody_accounts');
    }
}
