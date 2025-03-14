<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumeUserskillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_userskills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('resumesubsection_id')->nullable();
            $table->integer('userskill_id')->nullable();
            $table->integer('order')->nullable();
            $table->text('content_override')->nullable();
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
        Schema::dropIfExists('resume_userskills');
    }
}
