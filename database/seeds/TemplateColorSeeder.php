<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
     {
        $field_tips = array(
             // template 1
             array( 'template_id' => 1, 'color_id' =>1,'order'=>1,'active'=>1 ),
             array( 'template_id' => 1, 'color_id' =>2,'order'=>2,'active'=>1 ),
            array( 'template_id' => 1, 'color_id' =>3,'order'=>3,'active'=>1 ),
            array( 'template_id' => 1, 'color_id' =>4,'order'=>4,'active'=>1 ),
            array( 'template_id' => 1, 'color_id' =>5,'order'=>5,'active'=>1 ),
            // template 2
            array( 'template_id' => 2, 'color_id' =>6,'order'=>1,'active'=>1 ),
            array( 'template_id' => 2, 'color_id' =>7,'order'=>2,'active'=>1 ),
            array( 'template_id' => 2, 'color_id' =>8,'order'=>3,'active'=>1 ),
            array( 'template_id' => 2, 'color_id' =>9,'order'=>4,'active'=>1 ),
            array( 'template_id' => 2, 'color_id' =>10,'order'=>5,'active'=>1 ),
            // template 3
            array( 'template_id' => 3, 'color_id' =>11,'order'=>1,'active'=>1 ),
            array( 'template_id' => 3, 'color_id' =>12,'order'=>2,'active'=>1 ),
            array( 'template_id' => 3, 'color_id' =>13,'order'=>3,'active'=>1 ),
            // template 4
            array( 'template_id' => 4, 'color_id' =>14,'order'=>1,'active'=>1 ),
            array( 'template_id' => 4, 'color_id' =>15,'order'=>2,'active'=>1 ),
            array( 'template_id' => 4, 'color_id' =>16,'order'=>3,'active'=>1 ),
            // template 5
            array( 'template_id' => 5, 'color_id' =>17,'order'=>1,'active'=>1 ),
            array( 'template_id' => 5, 'color_id' =>18,'order'=>2,'active'=>1 ),
            array( 'template_id' => 5, 'color_id' =>19,'order'=>3,'active'=>1 ),
            array( 'template_id' => 5, 'color_id' =>20,'order'=>4,'active'=>1 ),
           );

        foreach($field_tips as $field){
            DB::table('templates_colors')->insert($field);
        }
    }
}