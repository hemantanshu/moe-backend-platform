<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoeReasonDefinitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moe_reason_definitions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->unsignedInteger('type_id')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('type_id')->references('id')->on('dz_lookup_values');
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
        Schema::dropIfExists('moe_reason_definitions');
    }
}
