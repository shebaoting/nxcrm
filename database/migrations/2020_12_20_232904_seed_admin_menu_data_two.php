<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedAdminMenuDataTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('admin_menu')->truncate();
        $admin_menu = [
            [
                'id' => '1',
                'parent_id' => '0',
                'order' => '1',
                'title' => 'Index',
                'icon' => 'feather icon-bar-chart-2',
                'uri' => '/',
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '2',
                'parent_id' => '0',
                'order' => '13',
                'title' => 'Admin',
                'icon' => 'feather icon-settings',
                'uri' => null,
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '3',
                'parent_id' => '2',
                'order' => '15',
                'title' => 'Users',
                'icon' => null,
                'uri' => 'auth/users',
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '4',
                'parent_id' => '2',
                'order' => '16',
                'title' => 'Roles',
                'icon' => null,
                'uri' => 'auth/roles',
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '5',
                'parent_id' => '2',
                'order' => '18',
                'title' => 'Permission',
                'icon' => '',
                'uri' => 'auth/permissions',
                'extension' => '',
                'show' => '0',
            ],
            [
                'id' => '6',
                'parent_id' => '2',
                'order' => '19',
                'title' => 'Menu',
                'icon' => null,
                'uri' => 'auth/menu',
                'extension' => '',
                'show' => '0',
            ],
            [
                'id' => '8',
                'parent_id' => '0',
                'order' => '2',
                'title' => 'sale',
                'icon' => 'fa-bar-chart',
                'uri' => null,
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '9',
                'parent_id' => '8',
                'order' => '4',
                'title' => 'customers',
                'icon' => 'fa-ship',
                'uri' => '/customers',
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '10',
                'parent_id' => '8',
                'order' => '5',
                'title' => 'contacts',
                'icon' => 'fa-user-circle',
                'uri' => '/contacts',
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '11',
                'parent_id' => '8',
                'order' => '7',
                'title' => 'events',
                'icon' => 'fa-commenting',
                'uri' => '/events',
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '12',
                'parent_id' => '0',
                'order' => '8',
                'title' => 'contract',
                'icon' => 'fa-diamond',
                'uri' => null,
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '13',
                'parent_id' => '12',
                'order' => '9',
                'title' => 'contract',
                'icon' => 'fa-trophy',
                'uri' => '/contracts',
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '14',
                'parent_id' => '12',
                'order' => '10',
                'title' => 'receipt',
                'icon' => 'fa-credit-card',
                'uri' => '/receipts',
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '15',
                'parent_id' => '8',
                'order' => '3',
                'title' => 'leads',
                'icon' => 'fa-flag',
                'uri' => '/leads',
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '16',
                'parent_id' => '8',
                'order' => '6',
                'title' => 'opportunitys',
                'icon' => 'fa-cc',
                'uri' => '/opportunitys',
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '17',
                'parent_id' => '2',
                'order' => '14',
                'title' => 'settings',
                'icon' => 'fa-gear',
                'uri' => '/settings/setting',
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '19',
                'parent_id' => '12',
                'order' => '11',
                'title' => 'invoices',
                'icon' => 'fa-credit-card',
                'uri' => '/invoices',
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '21',
                'parent_id' => '2',
                'order' => '17',
                'title' => 'products',
                'icon' => 'fa-codepen',
                'uri' => '/products',
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '22',
                'parent_id' => '12',
                'order' => '12',
                'title' => 'order',
                'icon' => 'fa-archive',
                'uri' => '/orders',
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '23',
                'parent_id' => '2',
                'order' => '20',
                'title' => 'Customfield',
                'icon' => null,
                'uri' => '/customfields',
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '25',
                'parent_id' => '0',
                'order' => '21',
                'title' => 'operations',
                'icon' => 'fa-modx',
                'uri' => null,
                'extension' => '',
                'show' => '1',
            ],
            [
                'id' => '26',
                'parent_id' => '25',
                'order' => '22',
                'title' => 'highseas',
                'icon' => null,
                'uri' => '/settings/highseas',
                'extension' => '',
                'show' => '1',
            ]
        ];//
        DB::table('admin_menu')->insert($admin_menu);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('admin_menu')->truncate();
    }
}
