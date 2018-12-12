<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentHashtagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_hashtag', function (Blueprint $table) {
            $table->unsignedInteger('hashtag_id');
            $table->unsignedInteger('comment_id');
            $table->foreign('hashtag_id')->references('id')->on('hashtags');
            $table->foreign('comment_id')->references('id')->on('comments');
            $table->timestamps();
            $table->primary(['hashtag_id', 'comment_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_hashtag');
    }
}
