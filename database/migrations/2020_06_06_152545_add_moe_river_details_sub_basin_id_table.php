<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoeRiverDetailsSubBasinIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('moe_river_details', function (Blueprint $table) {
            $table->unsignedInteger('sub_basin_id')->nullable();
            $table->foreign('sub_basin_id')->references('id')->on('moe_sub_basins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::table('moe_river_details', function (Blueprint $table) {
            $table->dropForeign('moe_river_details_sub_basin_id_foreign');
            $table->dropColumn('sub_basin_id');
        });
    }
}
