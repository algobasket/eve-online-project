<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColBidPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bid_posts', function ($table) {
		    $table->bigInteger('char_id')->after('bid_id')->index();
		    $table->string('bid_amount')->after('username');		   
		    $table->dateTime('end_date')->after('bid_amount')->index();		   	
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('bid_posts', function ($table) {
			$table->dropColumn('char_id');
			$table->dropColumn('bid_amount');
			$table->dropColumn('end_date');
		});
    }
}
