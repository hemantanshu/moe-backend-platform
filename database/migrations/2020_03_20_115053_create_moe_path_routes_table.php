<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoePathRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('moe_path_routes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('project_id')->nullable();
            $table->unsignedBigInteger('path_id')->nullable();
            $table->unsignedBigInteger('node_id')->nullable();

            $table->integer('order')->default(0);

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('project_id')->references('id')->on('moe_project_details');
            $table->foreign('path_id')->references('id')->on('moe_project_paths');
            $table->foreign('node_id')->references('id')->on('moe_project_activity_nodes');

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
        Schema::dropIfExists('moe_path_routes');
    }
}
