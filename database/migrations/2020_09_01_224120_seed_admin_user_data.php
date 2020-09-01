<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SeedAdminUserData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $admin_users = [
            [
                'username' => 'admin',
                'password' => '$2y$10$E98cUgucbSyEQbTARwj/mecinjzih3zTLLO3SgZ5T1U/qQ9AJe2Em',
                'name' => 'admin',
                'avatar' => 'images/9a9f560f0cafa5fa2b9356acdc5a40a2.jpg',
                'remember_token' => 'eIhLhW3Qvm2nuuRDhsaI1MaWa6S8zoKic4UD2MBy6t2spy5uLwua0MaPakOV',
            ],
            [
                'username' => 'niutiezhu',
                'password' => '$2y$10$E98cUgucbSyEQbTARwj/mecinjzih3zTLLO3SgZ5T1U/qQ9AJe2Em',
                'name' => 'niutiezhu',
                'avatar' => 'images/9a9f560f0cafa5fa2b9356acdc5a40a2.jpg',
                'remember_token' => 'eIhLhW3Qvm2nuuRDhsaI1MaWa6S8zoKic4UD2MBy6t2spy5uLwua0MaPakOV',
            ],
        ];//
        DB::table('admin_users')->insert($admin_users);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('admin_users')->truncate();
    }
}
