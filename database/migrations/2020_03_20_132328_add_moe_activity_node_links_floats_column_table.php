<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddMoeActivityNodeLinksFloatsColumnTable
 */
class AddMoeActivityNodeLinksFloatsColumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('moe_activity_node_links', function (Blueprint $table) {
            $table->integer('free_float')->default(0);
            $table->integer('total_float')->default(0);
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
            $table->dropColumn('free_float');
            $table->dropColumn('total_float');
        });
    }
}
