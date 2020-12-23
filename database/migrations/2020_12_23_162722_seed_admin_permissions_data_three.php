<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedAdminPermissionsDataThree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('admin_permissions')->truncate();
        $admin_permissions = [
            [
                        'id' => '1',
                        'name' => '系统',
                        'slug' => 'auth-management',
                        'http_method' => '',
                        'http_path' => '',
                        'order' => '13',
                        'parent_id' => '0',
            ],
            [
                        'id' => '2',
                        'name' => '团队',
                        'slug' => 'users',
                        'http_method' => '',
                        'http_path' => '/auth/users*',
                        'order' => '15',
                        'parent_id' => '1',
            ],
            [
                        'id' => '3',
                        'name' => '部门',
                        'slug' => 'roles',
                        'http_method' => '',
                        'http_path' => '/auth/roles*',
                        'order' => '16',
                        'parent_id' => '1',
            ],
            [
                        'id' => '4',
                        'name' => '权限',
                        'slug' => 'permissions',
                        'http_method' => '',
                        'http_path' => '/auth/permissions*',
                        'order' => '24',
                        'parent_id' => '24',
            ],
            [
                        'id' => '5',
                        'name' => '菜单',
                        'slug' => 'menu',
                        'http_method' => '',
                        'http_path' => '/auth/menu*',
                        'order' => '23',
                        'parent_id' => '24',
            ],
            [
                        'id' => '23',
                        'name' => '订单',
                        'slug' => 'orders',
                        'http_method' => 'GET',
                        'http_path' => '/orders',
                        'order' => '12',
                        'parent_id' => '22',
            ],
            [
                        'id' => '7',
                        'name' => '销售',
                        'slug' => 'sales',
                        'http_method' => '',
                        'http_path' => '',
                        'order' => '1',
                        'parent_id' => '0',
            ],
            [
                        'id' => '8',
                        'name' => '客户',
                        'slug' => 'customers',
                        'http_method' => '',
                        'http_path' => '/customers*',
                        'order' => '3',
                        'parent_id' => '7',
            ],
            [
                        'id' => '9',
                        'name' => '联系人',
                        'slug' => 'contacts',
                        'http_method' => '',
                        'http_path' => '/contacts*',
                        'order' => '4',
                        'parent_id' => '7',
            ],
            [
                        'id' => '10',
                        'name' => '跟进',
                        'slug' => 'events',
                        'http_method' => '',
                        'http_path' => '/events*',
                        'order' => '6',
                        'parent_id' => '7',
            ],
            [
                        'id' => '11',
                        'name' => '合同',
                        'slug' => 'contract',
                        'http_method' => '',
                        'http_path' => '/contracts*',
                        'order' => '9',
                        'parent_id' => '22',
            ],
            [
                        'id' => '12',
                        'name' => '收款',
                        'slug' => 'receipts',
                        'http_method' => '',
                        'http_path' => '/receipts*',
                        'order' => '10',
                        'parent_id' => '22',
            ],
            [
                        'id' => '13',
                        'name' => '线索',
                        'slug' => 'leads',
                        'http_method' => '',
                        'http_path' => '/leads*',
                        'order' => '2',
                        'parent_id' => '7',
            ],
            [
                        'id' => '14',
                        'name' => '商机',
                        'slug' => 'opportunitys',
                        'http_method' => '',
                        'http_path' => '/opportunitys*',
                        'order' => '5',
                        'parent_id' => '7',
            ],
            [
                        'id' => '15',
                        'name' => '系统',
                        'slug' => 'settings',
                        'http_method' => '',
                        'http_path' => '/settings*',
                        'order' => '14',
                        'parent_id' => '1',
            ],
            [
                        'id' => '17',
                        'name' => '发票',
                        'slug' => 'invoices',
                        'http_method' => '',
                        'http_path' => '/invoices*',
                        'order' => '11',
                        'parent_id' => '22',
            ],
            [
                        'id' => '18',
                        'name' => '产品',
                        'slug' => 'products',
                        'http_method' => '',
                        'http_path' => '/products*',
                        'order' => '17',
                        'parent_id' => '1',
            ],
            [
                        'id' => '19',
                        'name' => '字段',
                        'slug' => 'customfields',
                        'http_method' => '',
                        'http_path' => '/customfields*',
                        'order' => '18',
                        'parent_id' => '1',
            ],
            [
                        'id' => '21',
                        'name' => '分享',
                        'slug' => 'shares',
                        'http_method' => 'POST',
                        'http_path' => '/shares/store*',
                        'order' => '22',
                        'parent_id' => '24',
            ],
            [
                        'id' => '22',
                        'name' => '合同',
                        'slug' => 'contracts',
                        'http_method' => '',
                        'http_path' => '',
                        'order' => '8',
                        'parent_id' => '0',
            ],
            [
                        'id' => '24',
                        'name' => '其他',
                        'slug' => 'other',
                        'http_method' => '',
                        'http_path' => '',
                        'order' => '21',
                        'parent_id' => '0',
            ],
            [
                        'id' => '25',
                        'name' => '运营',
                        'slug' => 'operations',
                        'http_method' => '',
                        'http_path' => '',
                        'order' => '19',
                        'parent_id' => '0',
            ],
            [
                        'id' => '26',
                        'name' => '公海',
                        'slug' => 'highseas',
                        'http_method' => 'GET',
                        'http_path' => '/settings/*',
                        'order' => '20',
                        'parent_id' => '25',
                    ],
                    [
                        'id' => '27',
                        'name' => '附件',
                        'slug' => 'attachment',
                        'http_method' => '',
                        'http_path' => '/attachments/*',
                        'order' => '7',
                        'parent_id' => '7',
                    ]
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
