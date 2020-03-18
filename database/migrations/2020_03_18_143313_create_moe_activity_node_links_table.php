<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoeActivityNodeLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('moe_activity_node_links', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('project_id')->nullable();
            $table->unsignedBigInteger('tail_node_id')->nullable();
            $table->unsignedBigInteger('head_node_id')->nullable();
            $table->unsignedBigInteger('activity_id')->nullable();

            $table->integer('duration')->default(0);

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('project_id')->references('id')->on('moe_project_details');
            $table->foreign('tail_node_id')->references('id')->on('moe_project_activity_nodes');
            $table->foreign('head_node_id')->references('id')->on('moe_project_activity_nodes');
            $table->foreign('activity_id')->references('id')->on('moe_work_activities');

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
        Schema::dropIfExists('moe_activity_node_links');
    }
}
