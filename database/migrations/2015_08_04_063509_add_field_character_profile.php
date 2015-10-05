<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldCharacterProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('character_profile', function ($table) {
		    $table->bigInteger('char_id')->after('username')->index();
		    $table->smallInteger('is_protected')->after('security_status');
		    $table->smallInteger('status')->after('is_protected');		
		    $table->string('last_update_character')->after('is_protected')->nullable;		
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('character_profile', function ($table) {
			$table->dropColumn('char_id');
		    $table->dropColumn('is_protected');
		    $table->dropColumn('status');		  
		    $table->dropColumn('last_update_character');		  
		});
    }
}
