<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDzChartDetailsPlacementIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('dz_chart_details', function (Blueprint $table) {
            $table->unsignedInteger('placement_id')->nullable();
            $table->foreign('placement_id')->references('id')->on('dz_lookup_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::table('dz_chart_details', function (Blueprint $table) {
            $table->dropForeign('dz_chart_details_placement_id_foreign');
            $table->dropColumn('placement_id');
        });
    }
}
