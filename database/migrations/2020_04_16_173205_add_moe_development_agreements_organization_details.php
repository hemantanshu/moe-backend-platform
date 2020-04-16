<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoeDevelopmentAgreementsOrganizationDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('moe_development_agreements', function (Blueprint $table) {
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');

            $table->string('name');
            $table->string('description')->nullable();

            $table->unsignedInteger('developer_id')->nullable();
            $table->foreign('developer_id')->references('id')->on('moe_developer_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('moe_development_agreements', function (Blueprint $table) {
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->dropColumn('name');
            $table->dropColumn('description');

            $table->dropForeign('moe_development_agreements_developer_id_foreign');
            $table->dropColumn('developer_id');
        });
    }
}
