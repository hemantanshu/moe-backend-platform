<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddProjectScheduleNameColumn
 */
class AddProjectScheduleNameColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('moe_project_schedules', function (Blueprint $table) {
            $table->string('name')->after('id')->nullable();
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
            $table->dropColumn('name');
        });
    }
}
