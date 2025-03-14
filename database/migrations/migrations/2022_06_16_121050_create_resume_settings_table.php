<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumeSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('resume_id');
            $table->boolean('is_month_year')->default(true);
            $table->boolean('is_year')->default(false);
            $table->boolean('is_dates')->default(true);
            $table->boolean('is_city_state_country')->default(true);
            $table->boolean('is_city_state')->default(false);
            $table->boolean('is_location')->default(true);
            $table->boolean('is_job_description')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resume_settings');
    }
}
