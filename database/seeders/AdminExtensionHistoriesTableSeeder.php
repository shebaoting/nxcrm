<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminExtensionHistoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_extension_histories')->delete();
        
        \DB::table('admin_extension_histories')->insert(array (
            0 => 
            array (
                'created_at' => '2021-02-21 11:44:33',
                'detail' => 'Initialize extension.',
                'id' => 4,
                'name' => 'dcat-admin.form-step',
                'type' => 1,
                'updated_at' => '2021-02-21 11:44:33',
                'version' => '1.0.0',
            ),
        ));
        
        
    }
}