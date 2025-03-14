<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateResumeSettingInfoAddressStatuss extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resume_settings', function (Blueprint $table) {
            $table->boolean('is_info_full_address_city')->default(false)->change();
            $table->boolean('is_info_city_state')->default(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('resume_settings', function (Blueprint $table) {
            $table->boolean('is_info_full_address_city')->default(true)->change();
            $table->boolean('is_info_city_state')->default(false)->change();
        });
    }
}