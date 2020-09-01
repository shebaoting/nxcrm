<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedAdminRolePermissionsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $admin_role_permissions = [
            [
                'role_id'=> 2,
                'permission_id'=> 8,
            ],
            [
                'role_id'=> 2,
                'permission_id'=> 9,
            ],
            [
                'role_id'=> 2,
                'permission_id'=> 10,
            ],
            [
                'role_id'=> 2,
                'permission_id'=> 11,
            ],
            [
                'role_id'=> 2,
                'permission_id'=> 12,
            ],
            [
                'role_id'=> 2,
                'permission_id'=> 13,
            ],
            [
                'role_id'=> 2,
                'permission_id'=> 14,
            ]
        ];
        DB::table('admin_role_permissions')->insert($admin_role_permissions);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('admin_role_permissions')->truncate();
    }
}
