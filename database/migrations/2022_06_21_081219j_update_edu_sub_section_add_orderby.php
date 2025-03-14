<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEduSubSectionAddOrderby extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('edu_subsection_contents', function (Blueprint $table) {            
            $table->integer('orderBy')->default(1)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('edu_subsection_contents', function (Blueprint $table) {
            $table->dropColumn('orderBy');
        });
    }
}