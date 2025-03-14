<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('columns')->nullable();
            $table->text('html?')->nullable();
            $table->text('css?')->nullable();
            $table->string('default_color')->nullable();
            $table->string('default_font')->nullable();
            $table->string('heading_font_size')->nullable();
            $table->string('subheading_font_size')->nullable();
            $table->string('body_font_size')->nullable();
            $table->string('top_bottom_margin')->nullable();
            $table->string('left_right_margin')->nullable();
            $table->string('heading_spacing')->nullable();
            $table->string('subheading_spacing')->nullable();
            $table->string('body_text_spacing')->nullable();
            $table->string('indent_spacing')->nullable();
            $table->text('subscription')->nullable();
            $table->integer('active')->nullable();
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
        Schema::dropIfExists('templates');
    }
}
