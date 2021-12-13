<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_permissions')->delete();
        
        \DB::table('admin_permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '系统',
                'slug' => 'auth-management',
                'http_method' => '',
                'http_path' => '',
                'order' => 15,
                'parent_id' => 0,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '团队',
                'slug' => 'users',
                'http_method' => '',
                'http_path' => '/auth/users*',
                'order' => 17,
                'parent_id' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '部门',
                'slug' => 'roles',
                'http_method' => '',
                'http_path' => '/auth/roles*',
                'order' => 18,
                'parent_id' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '权限',
                'slug' => 'permissions',
                'http_method' => '',
                'http_path' => '/auth/permissions*',
                'order' => 29,
                'parent_id' => 24,
                'created_at' => NULL,
                'updated_at' => '2021-03-12 12:32:08',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '菜单',
                'slug' => 'menu',
                'http_method' => '',
                'http_path' => '/auth/menu*',
                'order' => 28,
                'parent_id' => 24,
                'created_at' => NULL,
                'updated_at' => '2021-03-12 12:32:08',
            ),
            5 => 
            array (
                'id' => 7,
                'name' => '销售',
                'slug' => 'sales',
                'http_method' => '',
                'http_path' => '',
                'order' => 3,
                'parent_id' => 0,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            6 => 
            array (
                'id' => 8,
                'name' => '客户',
                'slug' => 'customers',
                'http_method' => '',
                'http_path' => '/customers*',
                'order' => 5,
                'parent_id' => 7,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            7 => 
            array (
                'id' => 9,
                'name' => '联系人',
                'slug' => 'contacts',
                'http_method' => '',
                'http_path' => '/contacts*',
                'order' => 6,
                'parent_id' => 7,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            8 => 
            array (
                'id' => 10,
                'name' => '跟进',
                'slug' => 'events',
                'http_method' => '',
                'http_path' => '/events*',
                'order' => 8,
                'parent_id' => 7,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            9 => 
            array (
                'id' => 11,
                'name' => '合同',
                'slug' => 'contract',
                'http_method' => '',
                'http_path' => '/contracts*',
                'order' => 11,
                'parent_id' => 22,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            10 => 
            array (
                'id' => 12,
                'name' => '收款',
                'slug' => 'receipts',
                'http_method' => '',
                'http_path' => '/receipts*',
                'order' => 12,
                'parent_id' => 22,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            11 => 
            array (
                'id' => 13,
                'name' => '线索',
                'slug' => 'leads',
                'http_method' => '',
                'http_path' => '/leads*',
                'order' => 4,
                'parent_id' => 7,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            12 => 
            array (
                'id' => 14,
                'name' => '商机',
                'slug' => 'opportunitys',
                'http_method' => '',
                'http_path' => '/opportunitys*',
                'order' => 7,
                'parent_id' => 7,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            13 => 
            array (
                'id' => 15,
                'name' => '系统',
                'slug' => 'settings',
                'http_method' => '',
                'http_path' => '/settings*',
                'order' => 16,
                'parent_id' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            14 => 
            array (
                'id' => 17,
                'name' => '发票',
                'slug' => 'invoices',
                'http_method' => '',
                'http_path' => '/invoices*',
                'order' => 13,
                'parent_id' => 22,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            15 => 
            array (
                'id' => 18,
                'name' => '产品',
                'slug' => 'products',
                'http_method' => '',
                'http_path' => '/products*',
                'order' => 19,
                'parent_id' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            16 => 
            array (
                'id' => 19,
                'name' => '字段',
                'slug' => 'customfields',
                'http_method' => '',
                'http_path' => '/customfields*',
                'order' => 20,
                'parent_id' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            17 => 
            array (
                'id' => 21,
                'name' => '分享',
                'slug' => 'shares',
                'http_method' => 'POST',
                'http_path' => '/shares/store*',
                'order' => 27,
                'parent_id' => 24,
                'created_at' => NULL,
                'updated_at' => '2021-03-12 12:32:08',
            ),
            18 => 
            array (
                'id' => 22,
                'name' => '合同',
                'slug' => 'contracts',
                'http_method' => '',
                'http_path' => '',
                'order' => 10,
                'parent_id' => 0,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            19 => 
            array (
                'id' => 23,
                'name' => '订单',
                'slug' => 'orders',
                'http_method' => 'GET',
                'http_path' => '/orders',
                'order' => 14,
                'parent_id' => 22,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            20 => 
            array (
                'id' => 24,
                'name' => '其他',
                'slug' => 'other',
                'http_method' => '',
                'http_path' => '',
                'order' => 26,
                'parent_id' => 0,
                'created_at' => NULL,
                'updated_at' => '2021-03-12 12:32:08',
            ),
            21 => 
            array (
                'id' => 25,
                'name' => '运营',
                'slug' => 'operations',
                'http_method' => '',
                'http_path' => '',
                'order' => 21,
                'parent_id' => 0,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            22 => 
            array (
                'id' => 26,
                'name' => '公海',
                'slug' => 'highseas',
                'http_method' => 'GET',
                'http_path' => '/settings/*',
                'order' => 22,
                'parent_id' => 25,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            23 => 
            array (
                'id' => 27,
                'name' => '附件',
                'slug' => 'attachment',
                'http_method' => '',
                'http_path' => '/attachments/*',
                'order' => 9,
                'parent_id' => 7,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:34:31',
            ),
            24 => 
            array (
                'id' => 28,
                'name' => '控制台',
                'slug' => 'index',
                'http_method' => '',
                'http_path' => '',
                'order' => 1,
                'parent_id' => 0,
                'created_at' => '2021-03-11 15:32:46',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            25 => 
            array (
                'id' => 29,
                'name' => '通讯录',
                'slug' => 'teams',
                'http_method' => 'GET',
                'http_path' => '/teams*',
                'order' => 2,
                'parent_id' => 28,
                'created_at' => '2021-03-11 15:34:25',
                'updated_at' => '2021-03-11 15:34:42',
            ),
            26 => 
            array (
                'id' => 30,
                'name' => '资料',
                'slug' => 'content',
                'http_method' => '',
                'http_path' => '',
                'order' => 23,
                'parent_id' => 0,
                'created_at' => '2021-03-12 04:18:50',
                'updated_at' => '2021-03-12 12:30:39',
            ),
            27 => 
            array (
                'id' => 31,
                'name' => '合同范本',
                'slug' => 'modelcontracts',
                'http_method' => '',
                'http_path' => '/modelcontracts*',
                'order' => 25,
                'parent_id' => 30,
                'created_at' => '2021-03-12 04:19:32',
                'updated_at' => '2021-03-12 12:32:08',
            ),
            28 => 
            array (
                'id' => 32,
                'name' => '公司信息',
                'slug' => 'companys',
                'http_method' => 'GET',
                'http_path' => '/settings/*',
                'order' => 24,
                'parent_id' => 30,
                'created_at' => '2021-03-12 12:31:54',
                'updated_at' => '2021-03-12 12:32:08',
            ),
            29 => 
            array (
                'id' => 33,
                'name' => '目标业绩',
                'slug' => 'programs',
                'http_method' => '',
                'http_path' => '/programs*',
                'order' => 30,
                'parent_id' => 24,
                'created_at' => '2021-03-24 00:10:24',
                'updated_at' => '2021-03-24 00:10:24',
            ),
        ));
        
        
    }
}