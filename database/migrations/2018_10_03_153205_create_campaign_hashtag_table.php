<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignHashtagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_hashtag', function (Blueprint $table) {
            $table->unsignedInteger('hashtag_id');
            $table->unsignedInteger('campaign_id');
            $table->foreign('hashtag_id')->references('id')->on('hashtags');
            $table->foreign('campaign_id')->references('id')->on('campaigns');
            $table->timestamps();
            $table->primary(['hashtag_id', 'campaign_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_hashtag');
    }
}
