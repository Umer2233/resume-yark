<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {            
            $table->string('subscription_payment_status',150)->after('subscription_downgrade')->default(0);      
        });
        
        Schema::table('payments', function (Blueprint $table) {  
             $table->integer('user_id')->after('id')->nullable();          
             $table->string('charge_id',150)->after('user_id')->nullable();      
             $table->string('customer_id',150)->after('charge_id')->nullable();      
             $table->decimal('amount',8,2)->after('customer_id')->nullable();  
             $table->string('status',100)->after('amount')->nullable();      
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
            $table->dropColumn('subscription_payment_status');
           
        });
        
        Schema::table('payments', function (Blueprint $table) {            
            $table->dropColumn('charge_id');
            $table->dropColumn('customer_id');
            $table->dropColumn('status');
            $table->dropColumn('amount');
        });
       
    }
}