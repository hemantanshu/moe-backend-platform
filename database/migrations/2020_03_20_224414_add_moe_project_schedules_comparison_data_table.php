<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoeProjectSchedulesComparisonDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('moe_project_schedules', function (Blueprint $table) {
            $table->integer('optimistic_duration')->default(0);
            $table->integer('pessimistic_duration')->default(0);

            $table->decimal('mean_factor_1', 7, 2)->default(0);
            $table->decimal('sigma_factor_1', 7, 2)->default(0);

            $table->decimal('mean_factor_2', 7, 2)->default(0);
            $table->decimal('sigma_factor_2', 7, 2)->default(0);

            $table->integer('mean_avg')->default(0);
            $table->integer('sigma_avg')->default(0);

            $table->integer('suggested_duration')->default(0);

            $table->date('suggested_start_date')->nullable();
            $table->date('suggested_end_date')->nullable();
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
            $table->dropColumn('optimistic_duration');
            $table->dropColumn('pessimistic_duration');

            $table->dropColumn('mean_factor_1', 7, 2);
            $table->dropColumn('sigma_factor_1', 7, 2);

            $table->dropColumn('mean_factor_2', 7, 2);
            $table->dropColumn('sigma_factor_2', 7, 2);

            $table->dropColumn('mean_avg');
            $table->dropColumn('sigma_avg');

            $table->dropColumn('suggested_duration');

            $table->dropColumn('suggested_start_date');
            $table->dropColumn('suggested_end_date');
        });
    }
}
