<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bid_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bid_id')->index();
            $table->bigInteger('threadid');
            $table->bigInteger('post_id');
            $table->integer('post_rank');
            $table->dateTime('post_time');
            $table->longText('wall_post');
            $table->string('profile_link');
            $table->string('username');
			$table->dateTime('update_time');
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
        Schema::drop('bid_posts');
    }
}
