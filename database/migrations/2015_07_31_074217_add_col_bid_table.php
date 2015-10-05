<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColBidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bid_details', function (Blueprint $table) {
            $table->string('maintitle')->nullable()->change();
		    $table->bigInteger('threadid')->change();
		    $table->string('pilotname')->nullable()->change();
		    $table->integer('topicreplies')->change();
		    $table->integer('topicviews')->change();
		    $table->integer('topiclikes')->change();
		    $table->dateTime('lastpost_time')->nullable()->change();
		    $table->smallInteger('update_status')->change();
		    $table->smallInteger('page')->change();
		    $table->smallInteger('status')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bid_details', function (Blueprint $table) {
            $table->dropColumn('maintitle');
		    $table->dropColumn('threadid');
		    $table->dropColumn('pilotname');
		    $table->dropColumn('topicreplies');
		    $table->dropColumn('topicviews');
		    $table->dropColumn('topiclikes');
		    $table->dropColumn('lastpost_time');
		    $table->dropColumn('update_status');
		    $table->dropColumn('page');
		    $table->dropColumn('status');
        });
    }
}
