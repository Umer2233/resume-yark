<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateResumseSubsectionAddActiveColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resumesubsection', function (Blueprint $table) {            
             $table->boolean('status')->default(true)->after('hidden');      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resumesubsection', function (Blueprint $table) {            
             $table->dropColumn('status');      
        });
    }
}