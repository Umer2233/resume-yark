<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEducationAddStatusColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('education', function (Blueprint $table) {
            $table->boolean('is_degree')->default(true);
            $table->boolean('is_major_field_study')->default(false);
            $table->boolean('is_grad_date')->default(false);
            $table->boolean('is_credits_completed')->default(false);
            $table->boolean('is_overall_gpa')->default(false);
            $table->boolean('is_major_gpa')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('education', function (Blueprint $table) {
            $table->dropColumn('is_degree');
            $table->dropColumn('is_major_field_study');
            $table->dropColumn('is_grad_date');
            $table->dropColumn('is_credits_completed');
            $table->dropColumn('is_overall_gpa');
            $table->dropColumn('is_major_gpa');
           
        });
    }
    
}