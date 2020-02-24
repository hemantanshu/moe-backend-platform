<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoeReasonMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moe_reason_mappings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('source_type')->nullable();
            $table->unsignedInteger('source_id')->nullable();

            $table->unsignedBigInteger('reason_id')->nullable();
            $table->string('comments')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('reason_id')->references('id')->on('moe_reason_definitions');
            $table->index(['source_type', 'source_id']);

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
        Schema::dropIfExists('moe_reason_mappings');
    }
}
