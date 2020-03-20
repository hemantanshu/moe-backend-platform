<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoeActivityNodeLinksLagColumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('moe_activity_node_links', function (Blueprint $table) {
            $table->integer('lag')->default(0);
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
            $table->dropColumn('lag');
        });
    }
}
