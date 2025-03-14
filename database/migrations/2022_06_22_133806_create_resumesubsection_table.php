<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumesubsectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumesubsection', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('resumesection_id')->nullable();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->integer('order')->nullable();
            $table->string('list_style')->nullable();
            $table->string('hidden')->nullable();
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
        Schema::dropIfExists('resumesubsection');
    }
}
