<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job', function (Blueprint $table) {
            $table->boolean('is_month_year')->default(true);
            $table->boolean('is_year')->default(false);
            $table->boolean('is_dates')->default(true);
            $table->boolean('is_city_state_country')->default(true);
            $table->boolean('is_city_state')->default(false);
            $table->boolean('is_location')->default(true);
            $table->boolean('is_job_description')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job', function (Blueprint $table) {
            $table->dropColumn('is_month_year');
            $table->dropColumn('is_year');
            $table->dropColumn('is_dates');
            $table->dropColumn('is_city_state_country');
            $table->dropColumn('is_city_state');
            $table->dropColumn('is_location');
            $table->dropColumn('is_job_description');
        });
    }
}
