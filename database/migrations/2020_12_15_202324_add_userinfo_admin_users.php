<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserinfoAdminUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_users',function (Blueprint $table) {
            $table->char('mobile')->after('name')->nullable();
            $table->char('qq')->after('name')->nullable();
            $table->string('wechat')->after('name')->nullable();
            $table->date('birthday')->after('name')->nullable();
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
            $table->dropColumn('mobile');
            $table->dropColumn('qq');
            $table->dropColumn('wechat');
            $table->dropColumn('birthday');
        });
    }
}
