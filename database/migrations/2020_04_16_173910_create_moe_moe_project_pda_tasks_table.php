<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoeMoeProjectPdaTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('moe_project_pda_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('project_pda_id')->nullable();
            $table->unsignedBigInteger('pda_task_id')->nullable();

            $table->date('estimate_start_date')->nullable();
            $table->date('estimate_end_date')->nullable();

            $table->date('actual_start_date')->nullable();
            $table->date('actual_end_date')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('project_pda_id')->references('id')->on('moe_development_agreements');
            $table->foreign('pda_task_id')->references('id')->on('moe_pda_tasks');

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
        Schema::dropIfExists('moe_project_pda_tasks');
    }
}
