<?php

use Drivezy\LaravelAdmin\Database\Seeds\MenuSeeder;
use Drivezy\LaravelUtility\LaravelUtility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDzMenuDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('dz_menu_details', function (Blueprint $table) {
            $userTable = LaravelUtility::getUserTable();

            $table->increments('id');

            $table->string('name');
            $table->string('url');

            $table->string('image')->nullable();
            $table->text('includes')->nullable();
            $table->string('route')->nullable();

            $table->boolean('visible')->default(true);

            $table->string('restricted_query')->nullable();
            $table->string('restricted_column')->nullable();
            $table->string('documentation_url')->nullable();

            $table->unsignedInteger('page_id')->nullable();
            $table->string('order_definition')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('page_id')->references('id')->on('dz_page_definitions');

            $table->foreign('created_by')->references('id')->on($userTable);
            $table->foreign('updated_by')->references('id')->on($userTable);

            $table->timestamps();
            $table->softDeletes();
        });

        ( new MenuSeeder() )->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists('dz_menu_details');
    }
}
