<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FontTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $field_tips = array(
            array( 'name' => 'Sans Serif', 'font_family' => "sans-serif" ),
            array( 'name' => 'Fantasy', 'font_family' => "fantasy" ),
            array( 'name' => 'Cursive', 'font_family' => 'cursive' ),
            array( 'name' => 'Montserrat', 'font_family' => "'Montserrat', sans-serif" ),
            array( 'name' => 'Roboto', 'font_family' => "'Roboto', sans-serif" ),
            array( 'name' => 'Lora', 'font_family' => "'Lora', serif" ),
            array( 'name' => 'Archivo', 'font_family' => "'Archivo', sans-serif" ),
            array( 'name' => 'Exo', 'font_family' => "'Exo', sans-serif;"  ),
            array( 'name' => 'Merriweather', 'font_family' => "'Merriweather', serif" ),
            array( 'name' => 'Raleway', 'font_family' => "'Raleway', sans-serif" ),
            array( 'name' => 'Lato', 'font_family' => "'Lato', sans-serif" ),
            array( 'name' => 'Source Sans Pro', 'font_family' => "'Source Sans 3', sans-serif" ),
            array( 'name' => 'Poppins', 'font_family' => "'Poppins', sans-serif" ),
            array( 'name' => 'Work Sans', 'font_family' => "'Work Sans', sans-serif" ),
            array( 'name' => 'Playfair', 'font_family' => "'Playfair Display', serif" ),
           );
           foreach($field_tips as $field){
            DB::table('fonts')->insert($field);
          }
    }
}