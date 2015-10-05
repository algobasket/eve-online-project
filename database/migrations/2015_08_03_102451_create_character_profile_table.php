<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_profile', function (Blueprint $table) {
            $table->bigIncrements('id');			
			$table->bigInteger('uid')->index();			
            $table->string('username')->index();            
            $table->string('corporation');
			$table->string('alliance');
			$table->dateTime('dob');
			$table->decimal('isk', 15, 2);
			$table->decimal('avg_speed', 10, 2);
			$table->integer('intelligence');
            $table->integer('perception');
			$table->bigInteger('charisma');			
            $table->string('r_character');
            $table->string('b_character');
            $table->string('a_character');
            $table->string('clone');
            $table->integer('willpower');
            $table->integer('memory');
            $table->integer('remaps');
			$table->bigInteger('skillpoints');
			$table->bigInteger('unallocated');
			$table->string('profile_link');
			$table->string('login_details');
			$table->integer('sheet_viewd');
			$table->integer('daily_average');
            $table->integer('login_count');
            $table->float('security_status');			
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
        Schema::drop('character_profile');
    }
}
