<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoeProjectSchedulesDurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('moe_project_schedules', function (Blueprint $table) {
            $table->integer('estimated_duration')->default(0);
            $table->integer('actual_duration')->default(0);
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
            $table->dropColumn('estimated_duration');
            $table->dropColumn('actual_duration');
        });
    }
}
