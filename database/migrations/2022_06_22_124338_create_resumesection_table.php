<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumesectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumesection', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('resume_id')->nullable();
            $table->string('title')->nullable();
            $table->string('content')->nullable();
            $table->string('type')->nullable();
            $table->tinyInteger('column')->nullable();
            $table->integer('order')->nullable();
            $table->string('hidden')->nullable();
            $table->unsignedBigInteger('endorsement_id')->nullable();
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
        Schema::dropIfExists('resumesection');
    }
}
