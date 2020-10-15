<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedAdminPermissionsFieldData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $admin_permissions = [
            [
                'name' => '自定义字段',
                'slug' => 'customfields',
                'http_method' => '',
                'http_path' => '/customfields*',
                'order' => 9,
                'parent_id' => 1,
            ],
        ];//
        DB::table('admin_permissions')->insert($admin_permissions);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('admin_permissions')->truncate();
    }
}
