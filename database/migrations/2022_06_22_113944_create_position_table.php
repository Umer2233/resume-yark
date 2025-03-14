<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pos_name')->nullable();
            $table->longText('pos_description')->nullable();
            $table->string('soc_code')->nullable();
            $table->integer('major_gid')->nullable();
            $table->integer('minor_gid')->nullable();
            $table->string('url_desc')->nullable();
            $table->boolean('is_active')->default(false);
            $table->unsignedBigInteger('def_title_id')->nullable();
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
        Schema::dropIfExists('position');
    }
}
