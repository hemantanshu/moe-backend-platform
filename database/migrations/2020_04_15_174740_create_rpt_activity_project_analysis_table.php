<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRptActivityProjectAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('rpt_activity_project_analysis', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('work_activity_id')->nullable();

            $table->integer('equated_delay')->default(0);
            $table->integer('delay')->default(0);
            $table->integer('percentage')->default(0);

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('project_id')->references('id')->on('moe_project_details');
            $table->foreign('activity_id')->references('id')->on('moe_project_paths');

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
        Schema::dropIfExists('rpt_activity_project_analysis');
    }
}
