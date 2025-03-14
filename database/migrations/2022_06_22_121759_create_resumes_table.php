<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->unsignedBigInteger('title_id')->nullable();
            $table->string('name')->nullable();
            $table->boolean('middle_initial')->default(false);
            $table->text('address_display')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->integer('phone')->nullable();
            $table->string('profile')->nullable();
            $table->string('website')->nullable();
            $table->string('headline_type')->nullable();
            $table->boolean('hide_headline')->default(false);
            $table->unsignedBigInteger('headline_endorsement_id')->nullable();
            $table->text('employment_date')->nullable();
            $table->text('employment_location')->nullable();
            $table->boolean('employment_description')->default(true);
            $table->text('employment_emphasis')->nullable();
            $table->text('education_date')->nullable();
            $table->text('education_location')->nullable();
            $table->text('education_emphasis')->nullable();
            $table->boolean('expand_experienc')->default(true);
            $table->integer('type_assessment')->nullable();
            $table->decimal('chronological_score',10,2)->nullable();
            $table->text('type')->nullable();
            $table->integer('last_step')->nullable();
            $table->integer('template_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->unsignedBigInteger('font_id')->nullable();
            $table->integer('heading_font_size')->nullable();
            $table->integer('subheading_font_s')->nullable();
            $table->integer('body_font_size')->nullable();
            $table->integer('top_bottom_margi')->nullable();
            $table->integer('left_right_margin')->nullable();
            $table->integer('heading_spacing')->nullable();
            $table->integer('subheading_spacin')->nullable();
            $table->integer('body_text_spacing')->nullable();
            $table->integer('indent_spacing')->nullable();
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
        Schema::dropIfExists('resumes');
    }
}
