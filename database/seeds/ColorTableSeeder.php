<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $field_tips = array(
        //    template 1
            array( 'name' => 'Norbu’s Favorite', 'css?' => "",'primaryy_color'=>'#3CA3FA','secondary'=>'#F4FAFA','accent'=>'#F7DC4A','font'=>'#716971'),
            array( 'name' => 'Himalayan Dusk', 'css?' => "",'primaryy_color'=>'#274472','secondary'=>'#E2F0F2','accent'=>'#5885AF','font'=>'#716971'),
            array( 'name' => 'Old New School', 'css?' => "",'primaryy_color'=>'#658EA9','secondary'=>'#F7F3ED','accent'=>'#E98973','font'=>'#716971'),
            array( 'name' => 'Pantone’s Color', 'css?' => "",'primaryy_color'=>'#49702E','secondary'=>'F7F3ED','accent'=>'#72704a','font'=>'#716971'),
            array( 'name' => 'Pantone’s Color', 'css?' => "",'primaryy_color'=>'#414754','secondary'=>'E3E8F0','accent'=>'#82807F','font'=>'#716971'),
            // template 2
            array( 'name' => 'Norbu’s Favorite', 'css?' => "",'primaryy_color'=>'#000000','secondary'=>'#595959','accent'=>'#595959'),
            array( 'name' => 'Himalayan Dusk', 'css?' => "",'primaryy_color'=>'#145DA0','secondary'=>'#e87a00','accent'=>'#595959'),
            array( 'name' => 'Old New School', 'css?' => "",'primaryy_color'=>'#2F435A','secondary'=>'#39918c','accent'=>'#595959'),
            array( 'name' => 'Pantone’s Color', 'css?' => "",'primaryy_color'=>'#E34234','secondary'=>'#3b0918','accent'=>'#595959'),
            array( 'name' => 'Latest Color', 'css?' => "",'primaryy_color'=>'#145DA0','secondary'=>'#738fa7','accent'=>'#595959'),
           // template 3  
            array( 'name' => 'Norbu’s Favorite', 'css?' => "",'primaryy_color'=>'#209BCE','secondary'=>'#FFFFFF','accent'=>'#FFFFFF','font'=>'#595959'),
            array( 'name' => 'Himalayan Dusk', 'css?' => "",'primaryy_color'=>'#3C383A','secondary'=>'#FBD70F','accent'=>'#FAFAFA','font'=>'#2E2E2E'),
            array( 'name' => 'Old New School', 'css?' => "",'primaryy_color'=>'#ECECEC','secondary'=>'#094c53','accent'=>'#2E2E2E','font'=>'#2E2E2E','swap'=>1),
           // template 4 
            array( 'name' => 'Norbu’s Favorite', 'css?' => "",'primaryy_color'=>'#203864','secondary'=>'#FFFFFF','accent'=>'#FFA338','font'=>'#595959'),
            array( 'name' => 'Himalayan Dusk', 'css?' => "",'primaryy_color'=>'#FFFFFF','secondary'=>'#000000','accent'=>'#000000','font'=>'#595959'),
            array( 'name' => 'Old New School', 'css?' => "",'primaryy_color'=>'#F9ACAC','secondary'=>'#F9F9F8','accent'=>'#2E2E2E','font'=>'#000000'),
           // template 5
            array( 'name' => 'Norbu’s Favorite', 'css?' => "",'primaryy_color'=>'#6ABEDA','secondary'=>'#FFFFFF','accent'=>'#F6F5F5','font'=>'#2E2E2E'),
            array( 'name' => 'Himalayan Dusk', 'css?' => "",'primaryy_color'=>'#92D050','secondary'=>'#FFFFFF','accent'=>'#F6F5F5','font'=>'#2E2E2E'),
            array( 'name' => 'Old New School', 'css?' => "",'primaryy_color'=>'#F9ACAC','secondary'=>'#FFFFFF','accent'=>'#F6F5F5','font'=>'#2E2E2E'),
             array( 'name' => 'Latest Color', 'css?' => "",'primaryy_color'=>'#8a79a6','secondary'=>'#FFFFFF','accent'=>'#F6F5F5','font'=>'#2E2E2E'),
           
        );
           
           
           foreach($field_tips as $field){
            DB::table('colors')->insert($field);
          }
    }
}