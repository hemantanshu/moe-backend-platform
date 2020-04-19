<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoeProjectCostsEquatedCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('moe_project_costs', function (Blueprint $table) {
            $table->decimal('equated_cost', 10, 3)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('moe_project_costs', function (Blueprint $table) {
            $table->dropColumn('equated_cost');
        });
    }
}
