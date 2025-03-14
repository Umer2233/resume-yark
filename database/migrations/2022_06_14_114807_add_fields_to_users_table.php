<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_middle')->default(false);
            $table->boolean('is_email')->default(true);
            $table->boolean('is_phone')->default(true);
            $table->boolean('is_pro')->default(true);
            $table->boolean('is_web')->default(true);

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
            $table->dropColumn('is_middle');
            $table->dropColumn('is_email');
            $table->dropColumn('is_phone');
            $table->dropColumn('is_pro');
            $table->dropColumn('is_web');
        });
    }
}
