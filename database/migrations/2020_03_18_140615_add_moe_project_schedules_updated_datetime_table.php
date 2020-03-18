<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoeProjectSchedulesUpdatedDatetimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('moe_project_schedules', function (Blueprint $table) {
            $table->date('updated_estimate_start_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::table('moe_project_schedules', function (Blueprint $table) {
            $table->dropColumn('updated_estimate_start_date');
        });
    }
}
