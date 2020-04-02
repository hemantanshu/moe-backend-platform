<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoeProjectActivityNodesTypeIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('moe_project_activity_nodes', function (Blueprint $table) {
            $table->unsignedInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('dz_lookup_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::table('moe_project_activity_nodes', function (Blueprint $table) {
            $table->dropForeign('moe_project_activity_nodes_type_id_foreign');
            $table->dropColumn('type_id');
        });
    }
}
