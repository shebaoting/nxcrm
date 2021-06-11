<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminExtensionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_extensions')->delete();
        
        \DB::table('admin_extensions')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'id' => 1,
                'is_enabled' => 1,
                'name' => 'dcat-admin.form-step',
                'options' => '',
                'updated_at' => NULL,
                'version' => '1.0.0',
            ),
        ));
        
        
    }
}