<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoeActivityNodeLinksTypeIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('moe_activity_node_links', function (Blueprint $table) {
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
        Schema::table('moe_activity_node_links', function (Blueprint $table) {
            $table->dropForeign('moe_activity_node_links_type_id_foreign');
            $table->dropColumn('type_id');
        });
    }
}
