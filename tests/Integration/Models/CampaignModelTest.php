<?php

namespace Tests\Integration\Models;

use App\Models\Campaign;
use App\Models\Hashtag;
use DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CampaignModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function does_campaign_get_its_hashtags()
    {
        $campaign = factory(Campaign::class)->create();

        $hashtags = factory(Hashtag::class, 5)->create();

        // unrelated tags
        factory(Hashtag::class, 3)->create();

        foreach ($hashtags as $hashtag) {
            DB::table('campaign_hashtag')->insert(
                ['hashtag_id' => $hashtag->id, 'campaign_id' => $campaign->id]
            );
        }
        $this->assertEquals(5, $campaign->hashtags()->count());
    }
}
