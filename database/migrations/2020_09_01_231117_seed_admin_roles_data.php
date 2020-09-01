<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedAdminRolesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $admin_roles = [
            [
                'name' => '创始人',
                'slug' => 'administrator',
            ],
            [
                'name' => '职员',
                'slug' => 'staff',
            ],
        ];//
        DB::table('admin_roles')->insert($admin_roles);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('admin_roles')->truncate();
    }
}
