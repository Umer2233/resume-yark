<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name',100);
            $table->string('middle_initial',1);
            $table->string('last_name',100);
            $table->string('street_address');
            $table->string('city',255);
            $table->string('state',255);
            $table->integer('country');
            $table->string('postal_code',20);
            $table->string('phone',20);
            $table->string('email',255)->unique();
            $table->string('professional_profile',255);
            $table->string('website',255);
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
        Schema::dropIfExists('users');
    }
}
