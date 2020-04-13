<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoeProjectSchedulesEquationDateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('moe_project_schedules', function (Blueprint $table) {
            $table->date('equated_suggested_start_date')->nullable();
            $table->date('equated_suggested_end_date')->nullable();
            $table->date('updated_equated_suggested_start_date')->nullable();
            $table->integer('equated_suggested_duration')->default(0);
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
            $table->dropColumn('equated_suggested_start_date');
            $table->dropColumn('equated_suggested_end_date');
            $table->dropColumn('updated_equated_suggested_start_date');
            $table->dropColumn('equated_suggested_duration');

        });
    }
}
