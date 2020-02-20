<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoeProjectSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('moe_project_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('project_id')->nullable();
            $table->foreign('project_id')->references('id')->on('moe_project_details');

            $table->unsignedBigInteger('work_activity_id')->nullable();
            $table->foreign('work_activity_id')->references('id')->on('moe_work_activities');


            $table->boolean('critical_activity')->default(false);

            $table->date('estimate_start_date')->nullable();
            $table->date('estimate_end_date')->nullable();

            $table->date('actual_start_date')->nullable();
            $table->date('actual_end_date')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('sys_users');
            $table->foreign('updated_by')->references('id')->on('sys_users');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists('moe_project_schedules');
    }
}
