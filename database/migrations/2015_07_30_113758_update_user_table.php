<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
		    $table->string('photo_small')->nullable()->change();;
		    $table->string('photo_large')->nullable()->change();;
		    $table->string('password')->nullable()->change();;
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
		    $table->string('photo_small')->change();;
		    $table->string('photo_large')->change();;
		    $table->string('password')->change();;
		});
    }
}
