<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEduSubsectionContenrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edu_subsection_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('resume_subsection_id');
            $table->string("type")->nullable();
            $table->integer('subsection_content_able_id');
            $table->string("subsection_content_able_type");
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('edu_subsection_contents');
    }
}