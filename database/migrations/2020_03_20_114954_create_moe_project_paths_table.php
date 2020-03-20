<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoeProjectPathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('moe_project_paths', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('project_id')->nullable();
            $table->boolean('is_critical_path')->default(false);

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('project_id')->references('id')->on('moe_project_details');
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
        Schema::dropIfExists('moe_project_paths');
    }
}
