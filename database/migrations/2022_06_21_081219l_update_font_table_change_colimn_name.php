<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFontTableChangeColimnName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('fonts', function (Blueprint $table) {      
            $table->dropColumn('css? / reference');      
            $table->string('font_family')->after('name');      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('fonts', function (Blueprint $table) {            
            $table->dropColumn('font_family');      
            $table->string('css? / reference')->after('name');      
        });
    }
}