<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateResumesectionjobColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
         Schema::table('resumesection_job', function (Blueprint $table) {
            $table->boolean('active')->default(true)->after('hidden');
             $table->integer('orderBy')->default(1)->after('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('resumesection_job', function (Blueprint $table) {
            $table->dropColumn('active');
            $table->dropColumn('orderBy');
        });
    }
    
}