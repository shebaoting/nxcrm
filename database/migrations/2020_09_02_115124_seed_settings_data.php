<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedSettingsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $settings = [
            [
                'key'=> 'crmname',
                'value'=> 'NXCRM'
            ],
            [
                'key'=> 'crmurl',
                'value'=> 'http://crm.com'
            ],
            [
                'key'=> 'color',
                'value'=> 'green'
            ],
            [
                'key'=> 'logo',
                'value'=> 'images/cd72985037b83d82150b76d50b12cf53.png'
            ],
            [
                'key'=> 'body_class',
                'value'=> '111'
            ]
        ];
        DB::table('settings')->insert($settings);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->truncate();
    }
}
