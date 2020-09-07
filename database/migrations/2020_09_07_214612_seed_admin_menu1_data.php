<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedAdminMenu1Data extends Migration
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
                'parent_id' => 12,
                'order' => 18,
                'title' => 'invoices',
                'icon' => 'fa-credit-card',
                'uri' => '/invoices',
            ],
        ];//
        DB::table('admin_menu')->insert($admin_menu);
    }


    public function down()
    {
        DB::table('admin_menu')->truncate();
    }
}
