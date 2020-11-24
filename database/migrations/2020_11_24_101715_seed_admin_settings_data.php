<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedAdminSettingsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $admin_settings = [
            [
                'slug'=> 'crmname',
                'value'=> 'NXCRM'
            ],
            [
                'slug'=> 'crmurl',
                'value'=> 'http://crm.com'
            ],
            [
                'slug'=> 'color',
                'value'=> 'green'
            ],
            [
                'slug'=> 'logo',
                'value'=> 'images/cd72985037b83d82150b76d50b12cf53.png'
            ],
            [
                'slug'=> 'body_class',
                'value'=> '111'
            ],
            [
                'slug'=> 'sidebar_style',
                'value'=> 'light'
            ],
            [
                'slug'=> 'menu_layout',
                'value'=> 'sidebar-separate'
            ]
        ];
        DB::table('admin_settings')->insert($admin_settings);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('admin_settings')->truncate();
    }
}
