<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldSuggestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $field_suggestions = array(
            array('id' => '1', 'field' => 'single-word', 'suggestion' => 'This is my single word suggestion', 'active' => '1', 'created_at' => '2022-12-06 16:26:18', 'updated_at' => '2022-12-06 16:26:18'),
            array('id' => '2', 'field' => 'position', 'suggestion' => 'This is my position suggestion', 'active' => '1', 'created_at' => '2022-12-06 16:26:18', 'updated_at' => '2022-12-06 16:26:18'),
            array('id' => '3', 'field' => 'level-or-years', 'suggestion' => 'This is my level or years suggestion', 'active' => '1', 'created_at' => '2022-12-06 16:26:18', 'updated_at' => '2022-12-06 16:26:18'),
            array('id' => '4', 'field' => 'prominent-aspect', 'suggestion' => 'This is my prominent aspect suggestion', 'active' => '1', 'created_at' => '2022-12-06 16:26:18', 'updated_at' => '2022-12-06 16:26:18'),
            array('id' => '5', 'field' => 'final-statement', 'suggestion' => 'This is my final statement suggestion', 'active' => '1', 'created_at' => '2022-12-06 16:26:18', 'updated_at' => '2022-12-06 16:26:18')
        );

        foreach ($field_suggestions as $field) {
            DB::table('field_suggestions')->insert($field);
        }
    }
}
