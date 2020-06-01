<?php

use Drivezy\LaravelUtility\LaravelUtility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRpProjectYearAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('rp_project_year_analysis',
            function (Blueprint $table) {
                $userTable = LaravelUtility::getUserTable();

                $table->increments('id');

                $table->integer('year')->default(0);
                $table->decimal('actual_installed_capacity', 10, 3)->default(0);
                $table->decimal('estimated_installed_capacity', 10, 3)->default(0);

                $table->decimal('actual_cumulative_installed_capacity', 10, 3)->default(0);
                $table->decimal('estimated_cumulative_installed_capacity', 10, 3)->default(0);

                $table->unsignedInteger('created_by')->nullable();
                $table->unsignedInteger('updated_by')->nullable();

                $table->foreign('created_by')->references('id')->on($userTable);
                $table->foreign('updated_by')->references('id')->on($userTable);

                $table->timestamps();
                $table->softDeletes();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists('rp_project_year_analysis');
    }
}
