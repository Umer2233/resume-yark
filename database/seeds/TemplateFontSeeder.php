<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateFontSeeder extends Seeder
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
            array( 'template_id' => 1, 'font_id' =>4,'order'=>1,'active'=>1 ),
            array( 'template_id' => 1, 'font_id' =>10,'order'=>2,'active'=>1 ),
            // template 2
            array( 'template_id' => 2, 'font_id' =>4,'order'=>1,'active'=>1 ),
            array( 'template_id' => 2, 'font_id' =>5,'order'=>2,'active'=>1 ),
            array( 'template_id' => 2, 'font_id' =>6,'order'=>3,'active'=>1 ),
            // template 3

             array( 'template_id' => 3, 'font_id' =>7,'order'=>1,'active'=>1 ),
            array( 'template_id' => 3, 'font_id' =>8,'order'=>2,'active'=>1 ),
            array( 'template_id' => 3, 'font_id' =>9,'order'=>3,'active'=>1 ),
            // template 4
             
            array( 'template_id' => 4, 'font_id' =>10,'order'=>1,'active'=>1 ),
            array( 'template_id' => 4, 'font_id' =>11,'order'=>2,'active'=>1 ),
            array( 'template_id' => 4, 'font_id' =>12,'order'=>3,'active'=>1 ),
            // template 5
            array( 'template_id' => 5, 'font_id' =>13,'order'=>1,'active'=>1 ),
            array( 'template_id' => 5, 'font_id' =>14,'order'=>2,'active'=>1 ),
            array( 'template_id' => 5, 'font_id' =>15,'order'=>3,'active'=>1 ),
           );

        foreach($field_tips as $field){
            DB::table('templates_fonts')->insert($field);
        }
    }
}