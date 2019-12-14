<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrivacySettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean( 'electronic_document_consent' )->nullable();
            $table->string( 'signee_first_name' )->nullable();
            $table->string( 'signee_last_name' )->nullable();
            $table->string( 'signee_email' )->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->dropColumns( [ 'electronic_document_consent', 'signee_first_name', 'signee_last_name', 'signee_email' ] );
        });
    }
}
