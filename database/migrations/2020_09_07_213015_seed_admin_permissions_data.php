<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedAdminPermissionsData extends Migration
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
                'name' => '发票',
                'slug' => 'invoices',
                'http_method' => '',
                'http_path' => '/invoices*',
                'order' => 16,
                'parent_id' => 7,
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
