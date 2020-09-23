<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrdersProductsIntoAdminMenu extends Migration
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
                'order' => 16,
                'title' => 'products',
                'icon' => 'fa-codepen',
                'uri' => '/products',
            ],
            [
                'parent_id' => 12,
                'order' => 20,
                'title' => 'order',
                'icon' => 'fa-archive',
                'uri' => '/orders',
            ],
        ]; //
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
