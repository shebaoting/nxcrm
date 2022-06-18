<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedMenuData extends Migration
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
                'name' => '授权管理',
                'slug' => 'auth-management',
                'http_method' => '',
                'http_path' => '',
                'order' => 1,
                'parent_id' => 0,
            ],
            [
                'name' => '用户管理',
                'slug' => 'users',
                'http_method' => '',
                'http_path' => '/auth/users*',
                'order' => 3,
                'parent_id' => 1,
            ],
            [
                'name' => '角色管理',
                'slug' => 'roles',
                'http_method' => '',
                'http_path' => '/auth/roles*',
                'order' => 4,
                'parent_id' => 1,
            ],
            [
                'name' => '权限管理',
                'slug' => 'permissions',
                'http_method' => '',
                'http_path' => '/auth/permissions*',
                'order' => 5,
                'parent_id' => 1,
            ],
            [
                'name' => '菜单管理',
                'slug' => 'menu',
                'http_method' => '',
                'http_path' => '/auth/menu*',
                'order' => 6,
                'parent_id' => 1,
            ],
            [
                'name' => '操作日志',
                'slug' => 'operation-log',
                'http_method' => '',
                'http_path' => '/auth/logs*',
                'order' => 7,
                'parent_id' => 1,
            ],
            [
                'name' => '销售管理',
                'slug' => 'sale',
                'http_method' => '',
                'http_path' => '',
                'order' => 8,
                'parent_id' => 0,
            ],
            [
                'name' => '客户',
                'slug' => 'customers',
                'http_method' => '',
                'http_path' => '/customers*',
                'order' => 9,
                'parent_id' => 7,
            ],
            [
                'name' => '联系人',
                'slug' => 'contacts',
                'http_method' => '',
                'http_path' => '/contacts*',
                'order' => 10,
                'parent_id' => 7,
            ],
            [
                'name' => '跟进',
                'slug' => 'events',
                'http_method' => '',
                'http_path' => '/events*',
                'order' => 11,
                'parent_id' => 7,
            ],
            [
                'name' => '合同',
                'slug' => 'contract',
                'http_method' => '',
                'http_path' => '/contracts*',
                'order' => 12,
                'parent_id' => 7,
            ],
            [
                'name' => '收款',
                'slug' => 'receipts',
                'http_method' => '',
                'http_path' => '/receipts*',
                'order' => 13,
                'parent_id' => 7,
            ],
            [
                'name' => '线索',
                'slug' => 'leads',
                'http_method' => '',
                'http_path' => '/leads*',
                'order' => 14,
                'parent_id' => 7,
            ],
            [
                'name' => '商机',
                'slug' => 'opportunitys',
                'http_method' => '',
                'http_path' => '/opportunitys*',
                'order' => 15,
                'parent_id' => 7,
            ],
            [
                'name' => '系统设置',
                'slug' => 'settings',
                'http_method' => '',
                'http_path' => '/settings*',
                'order' => 2,
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
