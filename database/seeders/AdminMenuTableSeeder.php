<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_menu')->delete();
        
        \DB::table('admin_menu')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'order' => 1,
                'title' => 'Index',
                'icon' => 'feather icon-bar-chart-2',
                'uri' => '/',
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 0,
                'order' => 17,
                'title' => 'Admin',
                'icon' => 'feather icon-settings',
                'uri' => NULL,
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:26:32',
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 2,
                'order' => 19,
                'title' => 'Users',
                'icon' => NULL,
                'uri' => 'auth/users',
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:26:32',
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 2,
                'order' => 20,
                'title' => 'Roles',
                'icon' => NULL,
                'uri' => 'auth/roles',
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:26:32',
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 2,
                'order' => 22,
                'title' => 'Permission',
                'icon' => '',
                'uri' => 'auth/permissions',
                'extension' => '',
                'show' => 0,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:26:32',
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => 2,
                'order' => 23,
                'title' => 'Menu',
                'icon' => NULL,
                'uri' => 'auth/menu',
                'extension' => '',
                'show' => 0,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:26:32',
            ),
            6 => 
            array (
                'id' => 8,
                'parent_id' => 0,
                'order' => 4,
                'title' => 'sale',
                'icon' => 'fa-bar-chart',
                'uri' => NULL,
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:26:49',
            ),
            7 => 
            array (
                'id' => 9,
                'parent_id' => 34,
                'order' => 8,
                'title' => 'customers',
                'icon' => 'fa-ship',
                'uri' => '/customers',
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:26:32',
            ),
            8 => 
            array (
                'id' => 10,
                'parent_id' => 34,
                'order' => 9,
                'title' => 'contacts',
                'icon' => 'fa-user-circle',
                'uri' => '/contacts',
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:26:32',
            ),
            9 => 
            array (
                'id' => 11,
                'parent_id' => 35,
                'order' => 12,
                'title' => 'events',
                'icon' => 'fa-commenting',
                'uri' => '/events',
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:26:32',
            ),
            10 => 
            array (
                'id' => 12,
                'parent_id' => 0,
                'order' => 13,
                'title' => 'Finance',
                'icon' => 'fa-btc',
                'uri' => NULL,
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:27:19',
            ),
            11 => 
            array (
                'id' => 13,
                'parent_id' => 35,
                'order' => 11,
                'title' => 'contract',
                'icon' => 'fa-trophy',
                'uri' => '/contracts',
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:26:32',
            ),
            12 => 
            array (
                'id' => 14,
                'parent_id' => 12,
                'order' => 14,
                'title' => 'receipt',
                'icon' => 'fa-credit-card',
                'uri' => '/receipts',
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:26:32',
            ),
            13 => 
            array (
                'id' => 15,
                'parent_id' => 8,
                'order' => 5,
                'title' => 'leads',
                'icon' => 'fa-flag',
                'uri' => '/leads',
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-03-11 15:26:49',
            ),
            14 => 
            array (
                'id' => 16,
                'parent_id' => 8,
                'order' => 6,
                'title' => 'opportunitys',
                'icon' => 'fa-cc',
                'uri' => '/opportunitys',
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:22:34',
            ),
            15 => 
            array (
                'id' => 17,
                'parent_id' => 2,
                'order' => 18,
                'title' => 'settings',
                'icon' => 'fa-gear',
                'uri' => '/settings/setting',
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:26:32',
            ),
            16 => 
            array (
                'id' => 19,
                'parent_id' => 12,
                'order' => 15,
                'title' => 'invoices',
                'icon' => 'fa-credit-card',
                'uri' => '/invoices',
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:26:32',
            ),
            17 => 
            array (
                'id' => 21,
                'parent_id' => 2,
                'order' => 21,
                'title' => 'products',
                'icon' => 'fa-codepen',
                'uri' => '/products',
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:26:32',
            ),
            18 => 
            array (
                'id' => 22,
                'parent_id' => 12,
                'order' => 16,
                'title' => 'order',
                'icon' => 'fa-archive',
                'uri' => '/orders',
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:26:32',
            ),
            19 => 
            array (
                'id' => 23,
                'parent_id' => 2,
                'order' => 24,
                'title' => 'customfield',
                'icon' => NULL,
                'uri' => '/customfields',
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:26:32',
            ),
            20 => 
            array (
                'id' => 25,
                'parent_id' => 0,
                'order' => 25,
                'title' => 'operations',
                'icon' => 'fa-modx',
                'uri' => NULL,
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:26:32',
            ),
            21 => 
            array (
                'id' => 26,
                'parent_id' => 25,
                'order' => 26,
                'title' => 'highseas',
                'icon' => NULL,
                'uri' => '/settings/highseas',
                'extension' => '',
                'show' => 1,
                'created_at' => NULL,
                'updated_at' => '2021-06-10 23:26:32',
            ),
            22 => 
            array (
                'id' => 27,
                'parent_id' => 1,
                'order' => 3,
                'title' => 'teams',
                'icon' => 'fa-address-book',
                'uri' => '/teams',
                'extension' => '',
                'show' => 1,
                'created_at' => '2021-03-11 15:24:46',
                'updated_at' => '2021-03-11 15:26:49',
            ),
            23 => 
            array (
                'id' => 28,
                'parent_id' => 1,
                'order' => 2,
                'title' => 'Index',
                'icon' => 'fa-bookmark',
                'uri' => '/',
                'extension' => '',
                'show' => 1,
                'created_at' => '2021-03-11 15:26:15',
                'updated_at' => '2021-03-11 15:26:49',
            ),
            24 => 
            array (
                'id' => 31,
                'parent_id' => 0,
                'order' => 28,
                'title' => 'contents',
                'icon' => 'fa-archive',
                'uri' => NULL,
                'extension' => '',
                'show' => 1,
                'created_at' => '2021-03-12 04:13:05',
                'updated_at' => '2021-12-08 01:50:39',
            ),
            25 => 
            array (
                'id' => 32,
                'parent_id' => 31,
                'order' => 30,
                'title' => 'modelcontracts',
                'icon' => 'fa-file-powerpoint-o',
                'uri' => '/modelcontracts',
                'extension' => '',
                'show' => 1,
                'created_at' => '2021-03-12 04:14:28',
                'updated_at' => '2021-12-08 01:50:39',
            ),
            26 => 
            array (
                'id' => 33,
                'parent_id' => 31,
                'order' => 29,
                'title' => 'companys',
                'icon' => 'fa-audio-description',
                'uri' => '/settings/company',
                'extension' => '',
                'show' => 1,
                'created_at' => '2021-03-12 12:29:51',
                'updated_at' => '2021-12-08 01:50:39',
            ),
            27 => 
            array (
                'id' => 34,
                'parent_id' => 0,
                'order' => 7,
                'title' => 'Customers',
                'icon' => 'fa-group',
                'uri' => NULL,
                'extension' => '',
                'show' => 1,
                'created_at' => '2021-06-10 23:21:54',
                'updated_at' => '2021-06-10 23:26:32',
            ),
            28 => 
            array (
                'id' => 35,
                'parent_id' => 0,
                'order' => 10,
                'title' => 'Business',
                'icon' => 'fa-gavel',
                'uri' => NULL,
                'extension' => '',
                'show' => 1,
                'created_at' => '2021-06-10 23:25:51',
                'updated_at' => '2021-06-10 23:26:32',
            ),
            29 => 
            array (
                'id' => 36,
                'parent_id' => 25,
                'order' => 27,
                'title' => 'CustomerPool',
                'icon' => 'fa-connectdevelop',
                'uri' => '/customerpool',
                'extension' => '',
                'show' => 1,
                'created_at' => '2021-12-08 01:50:33',
                'updated_at' => '2021-12-08 01:50:39',
            ),
        ));
        
        
    }
}