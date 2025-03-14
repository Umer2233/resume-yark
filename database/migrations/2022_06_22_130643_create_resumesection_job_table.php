<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumesectionJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumesection_job', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('resumesection_id')->nullable();
            $table->unsignedBigInteger('job_id')->nullable();
            $table->unsignedBigInteger('endorsement_id')->nullable();
            $table->string('order')->nullable();
            $table->text('description_override')->nullable();
            $table->string('hidden')->nullable();
            $table->integer('employment_gap')->nullable();
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
        Schema::dropIfExists('resumesection_job');
    }
}
