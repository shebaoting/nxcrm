<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPidIntoAdminRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_roles',function (Blueprint $table) {
            $table->integer('pid')->after('slug')->default(0);
            $table->integer('order')->after('slug')->default(0);
            $table->string('leader')->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_roles', function (Blueprint $table) {
            $table->dropColumn('pid');
            $table->dropColumn('order');
            $table->dropColumn('leader');
        });
    }
}
