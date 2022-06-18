<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedAdminRoleUsersData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $admin_role_users = [
            [
                'role_id'=> 1,
                'user_id'=> 1,
            ],
            [
                'role_id'=> 2,
                'user_id'=> 2,
            ],
        ];
        DB::table('admin_role_users')->insert($admin_role_users);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('admin_role_users')->truncate();
    }
}
