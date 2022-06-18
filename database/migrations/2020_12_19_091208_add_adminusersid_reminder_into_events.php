<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminusersidReminderIntoEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crm_events',function (Blueprint $table) {
            $table->integer('admin_user_id')->after('crm_opportunity_id')->nullable();
            $table->date('reminder')->after('crm_opportunity_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('admin_users_id');
            $table->dropColumn('reminder');
        });
    }
}
