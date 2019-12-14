<?php
use App\Distribution;
use App\Property;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('property', 'properties');
        Schema::table('properties', function (Blueprint $table) {
            //
            $table->renameColumn('opportunity_name', 'name');
            $table->renameColumn('opportunity_address', 'address');
            $table->bigInteger('cap_file_id')->unsigned()->nullable()->change();
            $table->string('property_type')->nullable();
        });

        foreach (Distribution::all() as $dist) {
            $p=$dist->property;
            $p->property_type = $dist->type;
            $p->cap_file_id = null;
            $p->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            //
            $table->renameColumn('name', 'opportunity_name');
            $table->renameColumn('address', 'opportunity_address');
            $table->dropColumn('property_type');
        });
        Schema::rename('properties', 'property');
    }
}
