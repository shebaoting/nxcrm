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
                'created_at' => NULL,
                'extension' => '',
                'icon' => 'feather icon-bar-chart-2',
                'id' => 1,
                'order' => 1,
                'parent_id' => 0,
                'show' => 1,
                'title' => 'Index',
                'updated_at' => NULL,
                'uri' => '/',
            ),
            1 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => 'feather icon-settings',
                'id' => 2,
                'order' => 17,
                'parent_id' => 0,
                'show' => 1,
                'title' => 'Admin',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => NULL,
            ),
            2 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => NULL,
                'id' => 3,
                'order' => 19,
                'parent_id' => 2,
                'show' => 1,
                'title' => 'Users',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => 'auth/users',
            ),
            3 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => NULL,
                'id' => 4,
                'order' => 20,
                'parent_id' => 2,
                'show' => 1,
                'title' => 'Roles',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => 'auth/roles',
            ),
            4 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => '',
                'id' => 5,
                'order' => 22,
                'parent_id' => 2,
                'show' => 0,
                'title' => 'Permission',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => 'auth/permissions',
            ),
            5 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => NULL,
                'id' => 6,
                'order' => 23,
                'parent_id' => 2,
                'show' => 0,
                'title' => 'Menu',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => 'auth/menu',
            ),
            6 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => 'fa-bar-chart',
                'id' => 8,
                'order' => 4,
                'parent_id' => 0,
                'show' => 1,
                'title' => 'sale',
                'updated_at' => '2021-03-11 15:26:49',
                'uri' => NULL,
            ),
            7 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => 'fa-ship',
                'id' => 9,
                'order' => 8,
                'parent_id' => 34,
                'show' => 1,
                'title' => 'customers',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => '/customers',
            ),
            8 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => 'fa-user-circle',
                'id' => 10,
                'order' => 9,
                'parent_id' => 34,
                'show' => 1,
                'title' => 'contacts',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => '/contacts',
            ),
            9 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => 'fa-commenting',
                'id' => 11,
                'order' => 12,
                'parent_id' => 35,
                'show' => 1,
                'title' => 'events',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => '/events',
            ),
            10 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => 'fa-btc',
                'id' => 12,
                'order' => 13,
                'parent_id' => 0,
                'show' => 1,
                'title' => 'Finance',
                'updated_at' => '2021-06-10 23:27:19',
                'uri' => NULL,
            ),
            11 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => 'fa-trophy',
                'id' => 13,
                'order' => 11,
                'parent_id' => 35,
                'show' => 1,
                'title' => 'contract',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => '/contracts',
            ),
            12 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => 'fa-credit-card',
                'id' => 14,
                'order' => 14,
                'parent_id' => 12,
                'show' => 1,
                'title' => 'receipt',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => '/receipts',
            ),
            13 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => 'fa-flag',
                'id' => 15,
                'order' => 5,
                'parent_id' => 8,
                'show' => 1,
                'title' => 'leads',
                'updated_at' => '2021-03-11 15:26:49',
                'uri' => '/leads',
            ),
            14 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => 'fa-cc',
                'id' => 16,
                'order' => 6,
                'parent_id' => 8,
                'show' => 1,
                'title' => 'opportunitys',
                'updated_at' => '2021-06-10 23:22:34',
                'uri' => '/opportunitys',
            ),
            15 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => 'fa-gear',
                'id' => 17,
                'order' => 18,
                'parent_id' => 2,
                'show' => 1,
                'title' => 'settings',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => '/settings/setting',
            ),
            16 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => 'fa-credit-card',
                'id' => 19,
                'order' => 15,
                'parent_id' => 12,
                'show' => 1,
                'title' => 'invoices',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => '/invoices',
            ),
            17 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => 'fa-codepen',
                'id' => 21,
                'order' => 21,
                'parent_id' => 2,
                'show' => 1,
                'title' => 'products',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => '/products',
            ),
            18 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => 'fa-archive',
                'id' => 22,
                'order' => 16,
                'parent_id' => 12,
                'show' => 1,
                'title' => 'order',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => '/orders',
            ),
            19 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => NULL,
                'id' => 23,
                'order' => 24,
                'parent_id' => 2,
                'show' => 1,
                'title' => 'customfield',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => '/customfields',
            ),
            20 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => 'fa-modx',
                'id' => 25,
                'order' => 25,
                'parent_id' => 0,
                'show' => 1,
                'title' => 'operations',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => NULL,
            ),
            21 => 
            array (
                'created_at' => NULL,
                'extension' => '',
                'icon' => NULL,
                'id' => 26,
                'order' => 26,
                'parent_id' => 25,
                'show' => 1,
                'title' => 'highseas',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => '/settings/highseas',
            ),
            22 => 
            array (
                'created_at' => '2021-03-11 15:24:46',
                'extension' => '',
                'icon' => 'fa-address-book',
                'id' => 27,
                'order' => 3,
                'parent_id' => 1,
                'show' => 1,
                'title' => 'teams',
                'updated_at' => '2021-03-11 15:26:49',
                'uri' => '/teams',
            ),
            23 => 
            array (
                'created_at' => '2021-03-11 15:26:15',
                'extension' => '',
                'icon' => 'fa-bookmark',
                'id' => 28,
                'order' => 2,
                'parent_id' => 1,
                'show' => 1,
                'title' => 'Index',
                'updated_at' => '2021-03-11 15:26:49',
                'uri' => '/',
            ),
            24 => 
            array (
                'created_at' => '2021-03-12 04:13:05',
                'extension' => '',
                'icon' => 'fa-archive',
                'id' => 31,
                'order' => 27,
                'parent_id' => 0,
                'show' => 1,
                'title' => 'contents',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => NULL,
            ),
            25 => 
            array (
                'created_at' => '2021-03-12 04:14:28',
                'extension' => '',
                'icon' => 'fa-file-powerpoint-o',
                'id' => 32,
                'order' => 29,
                'parent_id' => 31,
                'show' => 1,
                'title' => 'modelcontracts',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => '/modelcontracts',
            ),
            26 => 
            array (
                'created_at' => '2021-03-12 12:29:51',
                'extension' => '',
                'icon' => 'fa-audio-description',
                'id' => 33,
                'order' => 28,
                'parent_id' => 31,
                'show' => 1,
                'title' => 'companys',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => '/settings/company',
            ),
            27 => 
            array (
                'created_at' => '2021-06-10 23:21:54',
                'extension' => '',
                'icon' => 'fa-group',
                'id' => 34,
                'order' => 7,
                'parent_id' => 0,
                'show' => 1,
                'title' => 'Customers',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => NULL,
            ),
            28 => 
            array (
                'created_at' => '2021-06-10 23:25:51',
                'extension' => '',
                'icon' => 'fa-gavel',
                'id' => 35,
                'order' => 10,
                'parent_id' => 0,
                'show' => 1,
                'title' => 'Business',
                'updated_at' => '2021-06-10 23:26:32',
                'uri' => NULL,
            ),
        ));
        
        
    }
}