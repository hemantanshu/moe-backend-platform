<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysUserPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('sys_user_preferences', function (Blueprint $table) {

            $userTable = ( new User() )->getTable();
            $table->increments('id');

            $table->unsignedInteger('user_id')->nullable();

            $table->string('parameter');
            $table->text('value')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('user_id')->references('id')->on('sys_users');
            $table->foreign('created_by')->references('id')->on($userTable);
            $table->foreign('updated_by')->references('id')->on($userTable);

            $table->softDeletes();

            $table->timestamps();

            $table->index(['user_id', 'parameter']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists('sys_user_preferences');
    }
}
