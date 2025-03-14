<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTitlePositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('title_position', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('title_id')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->float('importance_rating')->nullable();
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
        Schema::dropIfExists('title_position');
    }
}
