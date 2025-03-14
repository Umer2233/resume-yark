<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionProductDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // cus_P12nE26n9FaJ65
        Schema::create('subscription_product_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('subscription_id');
            $table->string('type');
            $table->string('price_id');
            $table->integer('status')->default(1);           
            $table->timestamps();
        });

        Schema::table('subscription_history', function (Blueprint $table) {            
             $table->integer('sub_prod_id')->after('subscription_id')->nullable();      
             $table->string('subscription_id',255)->change();      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_product_details');
        Schema::table('subscription_history', function (Blueprint $table) {            
             $table->dropColumn('sub_prod_id');
             $table->integer('subscription_id');   
        });
    }
}