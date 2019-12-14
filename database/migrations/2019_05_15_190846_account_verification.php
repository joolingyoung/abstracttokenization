<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AccountVerification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_verification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('userid')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_website')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('email')->nullable();
            $table->string('job_title')->nullable();
            $table->string('tin')->nullable();
            $table->string('country')->nullable();
            $table->string('bio')->nullable();
            $table->string('portfolio_activity_amount')->nullable();
            $table->string('assets_under_management')->nullable();
            $table->string('square_feet_managed')->nullable();
            $table->text('principles')->nullable();
            $table->string('reference_type_1')->nullable();
            $table->string('reference_name_1')->nullable();
            $table->string('reference_phone_1')->nullable();
            $table->string('reference_email_1')->nullable();
            $table->string('reference_type_2')->nullable();
            $table->string('reference_name_2')->nullable();
            $table->string('reference_phone_2')->nullable();
            $table->string('reference_email_2')->nullable();
            $table->string('reference_type_3')->nullable();
            $table->string('reference_name_3')->nullable();
            $table->string('reference_phone_3')->nullable();
            $table->string('reference_email_3')->nullable();
            $table->string('reference_type_4')->nullable();
            $table->string('reference_name_4')->nullable();
            $table->string('reference_phone_4')->nullable();
            $table->string('reference_email_4')->nullable();
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
        Schema::drop('account_verification');
    }
}
