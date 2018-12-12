<?php

namespace Tests\Integration\Models;

use App\Models\Campaign;
use App\Models\Comment;
use App\Models\Hashtag;
use App\Models\Post;
use App\Models\User;
use DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HashtagModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function does_hashtag_get_its_comments()
    {
        $hashtag = factory(Hashtag::class)->create();

        $comments = factory(Comment::class, 5)->create([
            'user_id' => factory(User::class),
            'post_id' => factory(Post::class)->create(
                ['user_id' => factory(User::class)]
            )
        ]);

        // unrelated comments
        factory(Comment::class, 3)->create([
            'user_id' => factory(User::class),
            'post_id' => factory(Post::class)->create(
                ['user_id' => factory(User::class)]
            )
        ]);

        factory(Hashtag::class, 3)->create();


        foreach ($comments as $comment) {
            DB::table('comment_hashtag')->insert(
                ['hashtag_id' => $hashtag->id, 'comment_id' => $comment->id]
            );
        }

        $this->assertEquals(5, $hashtag->comments()->count());
    }

    /** @test */
    public function does_hashtag_get_its_posts()
    {
        $hashtag = factory(Hashtag::class)->create();

        $posts = factory(Post::class, 5)->create([
            'user_id' => factory(User::class)
        ]);

        // unrelated posts
        factory(Post::class, 3)->create([
            'user_id' => factory(User::class)
        ]);


        foreach ($posts as $post) {
            DB::table('hashtag_post')->insert(
                ['hashtag_id' => $hashtag->id, 'post_id' => $post->id]
            );
        }

        $this->assertEquals(5, $hashtag->posts()->count());
    }

    /** @test */
    public function does_hashtag_get_its_campaigns()
    {
        $hashtag = factory(Hashtag::class)->create();

        $campaigns = factory(Campaign::class, 5)->create();

        // unrelated campaigns
        factory(Campaign::class, 3)->create();


        foreach ($campaigns as $campaign) {
            DB::table('campaign_hashtag')->insert(
                ['hashtag_id' => $hashtag->id, 'campaign_id' => $campaign->id]
            );
        }

        $this->assertEquals(5, $hashtag->campaigns()->count());
    }
}
