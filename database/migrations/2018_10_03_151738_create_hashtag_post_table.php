<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHashtagPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hashtag_post', function (Blueprint $table) {
            $table->unsignedInteger('hashtag_id');
            $table->unsignedInteger('post_id');
            $table->foreign('hashtag_id')->references('id')->on('hashtags');
            $table->foreign('post_id')->references('id')->on('posts');
            $table->timestamps();
            $table->primary(['hashtag_id', 'post_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hashtag_post');
    }
}
