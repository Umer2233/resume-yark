<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserAddDeleted extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {            
             $table->integer('deleted')->after('renewal_date')->default(0);      
         });
         
        Schema::table('user_cards', function (Blueprint $table) {            
             $table->string('postal_code',255)->after('card_name')->nullable();      
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
             $table->dropColumn('deleted');
        });
        Schema::table('user_cards', function (Blueprint $table) {            
             $table->dropColumn('postal_code');
        });
    }
}