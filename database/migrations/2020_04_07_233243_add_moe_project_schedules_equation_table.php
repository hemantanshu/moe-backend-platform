<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoeProjectSchedulesEquationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('moe_project_schedules', function (Blueprint $table) {
            $table->string('equation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('moe_project_schedules', function (Blueprint $table) {
            $table->dropColumn('equation');
        });
    }
}
