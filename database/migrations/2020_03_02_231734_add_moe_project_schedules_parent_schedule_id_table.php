<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoeProjectSchedulesParentScheduleIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('moe_project_schedules', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_schedule_id')->nullable();
            $table->foreign('parent_schedule_id')->references('id')->on('moe_project_schedules');
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
            $table->dropForeign('moe_project_schedules_parent_schedule_id_foreign');
            $table->dropColumn('parent_schedule_id');
        });
    }
}
