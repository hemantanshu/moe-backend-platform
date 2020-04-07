<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesProjectTypeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('moe_project_activity_nodes', function (Blueprint $table) {
            $table->index(['project_id', 'type_id'], 'moe_project_activity_nodes_project_type_index');
        });

        Schema::table('moe_activity_node_links', function (Blueprint $table) {
            $table->index(['project_id', 'type_id'], 'moe_activity_node_links_project_type_index');
        });

        Schema::table('moe_project_paths', function (Blueprint $table) {
            $table->index(['project_id', 'type_id'], 'moe_project_paths_project_type_index');
        });

        Schema::table('moe_path_routes', function (Blueprint $table) {
            $table->index(['project_id', 'type_id'], 'moe_path_routes_project_type_index');
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
            $table->dropIndex('moe_project_activity_nodes_project_type_index');
        });

        Schema::table('moe_activity_node_links', function (Blueprint $table) {
            $table->dropIndex('moe_activity_node_links_project_type_index');
        });

        Schema::table('moe_project_paths', function (Blueprint $table) {
            $table->dropIndex('moe_project_paths_project_type_index');
        });

        Schema::table('moe_path_routes', function (Blueprint $table) {
            $table->dropIndex('moe_path_routes_project_type_index');
        });
    }
}
