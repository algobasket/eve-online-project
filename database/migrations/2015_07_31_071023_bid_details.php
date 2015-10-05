<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BidDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bid_details', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('maintitle',255);
		    $table->bigInteger('threadid');
		    $table->string('pilotname',100);
		    $table->integer('topicreplies');
		    $table->integer('topicviews');
		    $table->integer('topiclikes');
		    $table->dateTime('lastpost_time')->index();
		    $table->smallInteger('update_status');
		    $table->smallInteger('page');
		    $table->smallInteger('status');
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
        Schema::drop('bid_details');
    }
}
