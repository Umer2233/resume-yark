<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('school')->nullable();
            $table->unsignedBigInteger('school_id')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->unsignedBigInteger('country')->nullable();
            $table->unsignedBigInteger('degree')->nullable();
            $table->string('other_degree')->nullable();
            $table->string('major')->nullable();
            $table->integer('grad_month')->nullable();
            $table->integer('grad_year')->nullable();
            $table->double('overallgpa')->nullable();
            $table->double('majorgpa')->nullable();
            $table->double('totaloverallgpa')->nullable();
            $table->double('totalmajorgpa')->nullable();
            $table->double('credits_completed')->nullable();
            $table->string('credits_completed_phrase')->nullable();
            $table->date('grad_date')->nullable();
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
        Schema::dropIfExists('education');
    }
}