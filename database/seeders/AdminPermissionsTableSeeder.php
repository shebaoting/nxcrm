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
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '',
                'id' => 1,
                'name' => '系统',
                'order' => 15,
                'parent_id' => 0,
                'slug' => 'auth-management',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            1 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '/auth/users*',
                'id' => 2,
                'name' => '团队',
                'order' => 17,
                'parent_id' => 1,
                'slug' => 'users',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            2 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '/auth/roles*',
                'id' => 3,
                'name' => '部门',
                'order' => 18,
                'parent_id' => 1,
                'slug' => 'roles',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            3 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '/auth/permissions*',
                'id' => 4,
                'name' => '权限',
                'order' => 29,
                'parent_id' => 24,
                'slug' => 'permissions',
                'updated_at' => '2021-03-12 12:32:08',
            ),
            4 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '/auth/menu*',
                'id' => 5,
                'name' => '菜单',
                'order' => 28,
                'parent_id' => 24,
                'slug' => 'menu',
                'updated_at' => '2021-03-12 12:32:08',
            ),
            5 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '',
                'id' => 7,
                'name' => '销售',
                'order' => 3,
                'parent_id' => 0,
                'slug' => 'sales',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            6 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '/customers*',
                'id' => 8,
                'name' => '客户',
                'order' => 5,
                'parent_id' => 7,
                'slug' => 'customers',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            7 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '/contacts*',
                'id' => 9,
                'name' => '联系人',
                'order' => 6,
                'parent_id' => 7,
                'slug' => 'contacts',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            8 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '/events*',
                'id' => 10,
                'name' => '跟进',
                'order' => 8,
                'parent_id' => 7,
                'slug' => 'events',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            9 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '/contracts*',
                'id' => 11,
                'name' => '合同',
                'order' => 11,
                'parent_id' => 22,
                'slug' => 'contract',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            10 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '/receipts*',
                'id' => 12,
                'name' => '收款',
                'order' => 12,
                'parent_id' => 22,
                'slug' => 'receipts',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            11 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '/leads*',
                'id' => 13,
                'name' => '线索',
                'order' => 4,
                'parent_id' => 7,
                'slug' => 'leads',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            12 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '/opportunitys*',
                'id' => 14,
                'name' => '商机',
                'order' => 7,
                'parent_id' => 7,
                'slug' => 'opportunitys',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            13 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '/settings*',
                'id' => 15,
                'name' => '系统',
                'order' => 16,
                'parent_id' => 1,
                'slug' => 'settings',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            14 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '/invoices*',
                'id' => 17,
                'name' => '发票',
                'order' => 13,
                'parent_id' => 22,
                'slug' => 'invoices',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            15 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '/products*',
                'id' => 18,
                'name' => '产品',
                'order' => 19,
                'parent_id' => 1,
                'slug' => 'products',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            16 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '/customfields*',
                'id' => 19,
                'name' => '字段',
                'order' => 20,
                'parent_id' => 1,
                'slug' => 'customfields',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            17 => 
            array (
                'created_at' => NULL,
                'http_method' => 'POST',
                'http_path' => '/shares/store*',
                'id' => 21,
                'name' => '分享',
                'order' => 27,
                'parent_id' => 24,
                'slug' => 'shares',
                'updated_at' => '2021-03-12 12:32:08',
            ),
            18 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '',
                'id' => 22,
                'name' => '合同',
                'order' => 10,
                'parent_id' => 0,
                'slug' => 'contracts',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            19 => 
            array (
                'created_at' => NULL,
                'http_method' => 'GET',
                'http_path' => '/orders',
                'id' => 23,
                'name' => '订单',
                'order' => 14,
                'parent_id' => 22,
                'slug' => 'orders',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            20 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '',
                'id' => 24,
                'name' => '其他',
                'order' => 26,
                'parent_id' => 0,
                'slug' => 'other',
                'updated_at' => '2021-03-12 12:32:08',
            ),
            21 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '',
                'id' => 25,
                'name' => '运营',
                'order' => 21,
                'parent_id' => 0,
                'slug' => 'operations',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            22 => 
            array (
                'created_at' => NULL,
                'http_method' => 'GET',
                'http_path' => '/settings/*',
                'id' => 26,
                'name' => '公海',
                'order' => 22,
                'parent_id' => 25,
                'slug' => 'highseas',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            23 => 
            array (
                'created_at' => NULL,
                'http_method' => '',
                'http_path' => '/attachments/*',
                'id' => 27,
                'name' => '附件',
                'order' => 9,
                'parent_id' => 7,
                'slug' => 'attachment',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            24 => 
            array (
                'created_at' => '2021-03-11 15:32:46',
                'http_method' => '',
                'http_path' => '',
                'id' => 28,
                'name' => '控制台',
                'order' => 1,
                'parent_id' => 0,
                'slug' => 'index',
                'updated_at' => '2021-03-11 15:34:31',
            ),
            25 => 
            array (
                'created_at' => '2021-03-11 15:34:25',
                'http_method' => 'GET',
                'http_path' => '/teams*',
                'id' => 29,
                'name' => '通讯录',
                'order' => 2,
                'parent_id' => 28,
                'slug' => 'teams',
                'updated_at' => '2021-03-11 15:34:42',
            ),
            26 => 
            array (
                'created_at' => '2021-03-12 04:18:50',
                'http_method' => '',
                'http_path' => '',
                'id' => 30,
                'name' => '资料',
                'order' => 23,
                'parent_id' => 0,
                'slug' => 'content',
                'updated_at' => '2021-03-12 12:30:39',
            ),
            27 => 
            array (
                'created_at' => '2021-03-12 04:19:32',
                'http_method' => '',
                'http_path' => '/modelcontracts*',
                'id' => 31,
                'name' => '合同范本',
                'order' => 25,
                'parent_id' => 30,
                'slug' => 'modelcontracts',
                'updated_at' => '2021-03-12 12:32:08',
            ),
            28 => 
            array (
                'created_at' => '2021-03-12 12:31:54',
                'http_method' => 'GET',
                'http_path' => '/settings/*',
                'id' => 32,
                'name' => '公司信息',
                'order' => 24,
                'parent_id' => 30,
                'slug' => 'companys',
                'updated_at' => '2021-03-12 12:32:08',
            ),
            29 => 
            array (
                'created_at' => '2021-03-24 00:10:24',
                'http_method' => '',
                'http_path' => '/programs*',
                'id' => 33,
                'name' => '目标业绩',
                'order' => 30,
                'parent_id' => 24,
                'slug' => 'programs',
                'updated_at' => '2021-03-24 00:10:24',
            ),
        ));
        
        
    }
}