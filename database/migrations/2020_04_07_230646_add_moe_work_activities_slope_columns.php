<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoeWorkActivitiesSlopeColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('moe_work_activities', function (Blueprint $table) {
            $table->decimal('m_slope', 10, 5)->default(0);
            $table->decimal('c_y_intercept', 10, 5)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::table('moe_work_activities', function (Blueprint $table) {
            $table->dropColumn('m_slope');
            $table->dropColumn('c_y_intercept');
        });
    }
}
