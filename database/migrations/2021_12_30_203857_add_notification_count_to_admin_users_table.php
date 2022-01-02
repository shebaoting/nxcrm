<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotificationCountToAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            $table->integer('notification_count')->unsigned()->default(0);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->integer('notification_count')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            $table->dropColumn('notification_count');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('notification_count');
        });
    }
}
