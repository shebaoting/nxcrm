<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedAdminPermissionsSharesData extends Migration
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
                'name' => '分享',
                'slug' => 'shares',
                'http_method' => 'POST',
                'http_path' => '/shares/store*',
                'order' => 19,
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
