<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserAddStartDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {            
             $table->date('start_date')->after('renewal_date')->nullable();      
             $table->date('end_date')->after('start_date')->nullable();      
             $table->integer('subscription_downgrade')->after('current_resume_id')->default(0);      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
     Schema::table('users', function (Blueprint $table) {            
             $table->dropColumn('start_date');
             $table->dropColumn('end_date');
             $table->dropColumn('subscription_downgrade');
        });
    }
}