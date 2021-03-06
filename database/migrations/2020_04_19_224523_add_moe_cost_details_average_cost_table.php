<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoeCostDetailsAverageCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::table('moe_project_costs', function (Blueprint $table) {
            $table->decimal('suggested_cost', 10, 3)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::table('moe_project_costs', function (Blueprint $table) {
            $table->dropColumn('suggested_cost');
        });
    }
}
