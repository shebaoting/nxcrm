<?php

use Illuminate\Database\Seeder;

class AdminExtensionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admin_extensions')->truncate();
        $admin_extensions = [
            [
                'id' => '1',
                'name' => 'dcat-admin.form-step',
                'version' => '1.0.0',
                'is_enabled' => 1,
                'options' => '',
            ]
        ];//
        \DB::table('admin_extensions')->insert($admin_extensions);
    }
}
