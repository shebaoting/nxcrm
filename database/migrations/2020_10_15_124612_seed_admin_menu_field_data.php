<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedAdminMenuFieldData extends Migration
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
                'parent_id' => 2,
                'order' => 20,
                'title' => 'Customfield',
                'icon' => '',
                'uri' => '/customfields',
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
