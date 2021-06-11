<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(AdminMenuTableSeeder::class);
        $this->call(AdminExtensionHistoriesTableSeeder::class);
        $this->call(AdminExtensionsTableSeeder::class);
        $this->call(AdminPermissionsTableSeeder::class);
    }
}
