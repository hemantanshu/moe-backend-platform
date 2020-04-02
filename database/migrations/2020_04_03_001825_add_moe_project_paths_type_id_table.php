<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoeProjectPathsTypeIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('moe_project_paths', function (Blueprint $table) {
            $table->string('name')->nullable();
            
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
        Schema::table('moe_project_paths', function (Blueprint $table) {
            $table->dropColumn('name');

            $table->dropForeign('moe_project_paths_type_id_foreign');
            $table->dropColumn('type_id');
        });
    }
}
