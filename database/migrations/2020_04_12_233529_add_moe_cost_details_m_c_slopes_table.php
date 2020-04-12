<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoeCostDetailsMCSlopesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('moe_cost_details', function (Blueprint $table) {
            $table->decimal('m_slope', 10, 5)->default(0);
            $table->integer('c_y_intercept')->default(0);
            $table->decimal('co_relation', 10, 3)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('moe_cost_details', function (Blueprint $table) {
            $table->dropColumn('m_slope');
            $table->dropColumn('c_y_intercept');
            $table->dropColumn('equation');
        });
    }
}
