<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDowngradeSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downgrage_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->date('renewal_date')->nullable();
            $table->string('subscription_id')->nullable();
            $table->string('sub_pro_id')->nullable();
            $table->string('subscription_frequency')->nullable();
            $table->integer('status')->default(1);
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
        Schema::table('users', function (Blueprint $table) {
             $table->dropColumn('deleted');
        });
        Schema::table('user_cards', function (Blueprint $table) {
             $table->dropColumn('postal_code');
        });
    }
}