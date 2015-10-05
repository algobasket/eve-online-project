<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
		    $table->string('eve_user_id')->nullable();
		    $table->string('eve_api_key')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
		    $table->dropColumn('eve_user_id');
		    $table->dropColumn('eve_user_id');
		});
    }
}
