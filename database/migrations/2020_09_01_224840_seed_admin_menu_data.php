<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedAdminMenuData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $admin_menu = [
            [
                'parent_id' => 0,
                'order' => 1,
                'title' => 'Index',
                'icon' => 'feather icon-bar-chart-2',
                'uri' => '/',
            ],
            [
                'parent_id' => 0,
                'order' => 11,
                'title' => 'Admin',
                'icon' => 'feather icon-settings',
                'uri' => null,
            ],
            [
                'parent_id' => 2,
                'order' => 13,
                'title' => 'Users',
                'icon' => null,
                'uri' => 'auth/users',
            ],
            [
                'parent_id' => 2,
                'order' => 14,
                'title' => 'Roles',
                'icon' => null,
                'uri' => 'auth/roles',  
            ],
            [
                'parent_id' => 2,
                'order' => 15,
                'title' => 'Permission',
                'icon' => '',
                'uri' => 'auth/permissions',
            ],
            [
                'parent_id' => 2,
                'order' => 16,
                'title' => 'Menu',
                'icon' => null,
                'uri' => 'auth/menu',  
            ],
            [
                'parent_id' => 2,
                'order' => 17,
                'title' => 'Operation log',
                'icon' => null,
                'uri' => 'auth/logs',  
            ],
            [
                'parent_id' => 0,
                'order' => 2,
                'title' => 'sale',
                'icon' => 'fa-bar-chart',
                'uri' => null,
            ],
            [
                'parent_id' => 8,
                'order' => 4,
                'title' => 'customers',
                'icon' => 'fa-ship',
                'uri' => '/customers',
            ],
            [
                'parent_id' => 8,
                'order' => 5,
                'title' => 'contacts',
                'icon' => 'fa-user-circle',
                'uri' => '/contacts',
            ],
            [
                'parent_id' => 8,
                'order' => 7,
                'title' => 'events',
                'icon' => 'fa-commenting',
                'uri' => '/events',
            ],
            [
                'parent_id' => 0,
                'order' => 8,
                'title' => 'contract',
                'icon' => 'fa-diamond',
                'uri' => null,
            ],
            [
                'parent_id' => 12,
                'order' => 9,
                'title' => 'contract',
                'icon' => 'fa-trophy',
                'uri' => '/contracts',
            ],
            [
                'parent_id' => 12,
                'order' => 10,
                'title' => 'receipt',
                'icon' => 'fa-credit-card',
                'uri' => '/receipts',
            ],
            [
                'parent_id' => 8,
                'order' => 3,
                'title' => 'leads',
                'icon' => 'fa-flag',
                'uri' => '/leads',
            ],
            [
                'parent_id' => 8,
                'order' => 6,
                'title' => 'opportunitys',
                'icon' => 'fa-cc',
                'uri' => '/opportunitys',
            ],
            [
                'parent_id' => 2,
                'order' => 12,
                'title' => 'settings',
                'icon' => 'fa-gear',
                'uri' => '/settings',
            ],
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
