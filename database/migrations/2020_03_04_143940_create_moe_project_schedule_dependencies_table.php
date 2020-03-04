<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoeProjectScheduleDependenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moe_project_schedule_dependencies', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('project_schedule_id')->nullable();
            $table->unsignedBigInteger('dependency_id')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('project_schedule_id')->references('id')->on('moe_project_schedules');
            $table->foreign('dependency_id')->references('id')->on('moe_project_schedules');

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
    public function down()
    {
        Schema::dropIfExists('moe_project_schedule_dependencies');
    }
}
