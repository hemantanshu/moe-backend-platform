<?php

use Drivezy\LaravelUtility\LaravelUtility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDzNotificationTriggersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('dz_notification_triggers', function (Blueprint $table) {
            $userTable = LaravelUtility::getUserTable();

            $table->increments('id');

            $table->unsignedInteger('notification_id')->nullable();

            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();

            $table->integer('sms_notifications')->nullable();
            $table->integer('email_notifications')->nullable();
            $table->integer('push_notifications')->nullable();

            $table->string('log_file');

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('notification_id')->references('id')->on('dz_notification_details');

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
        Schema::dropIfExists('dz_notification_triggers');
    }
}
