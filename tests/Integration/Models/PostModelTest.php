<?php

namespace Tests\Integration\Models;

use App\Hamsaa\Constants\RelationshipStatus;
use App\Models\Comment;
use App\Models\Hashtag;
use App\Models\Label;
use App\Models\Post;
use App\Models\User;
use DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function does_post_get_its_user_if_it_is_not_anonymous()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create(
            ['user_id' => $user->id]
        );
        $this->assertEquals($user->id, $post->user->id);
    }

    /** @test */
    public function does_post_get_its_comments()
    {
        $post = factory(Post::class)->create([
            'user_id' => factory(User::class)
        ]);
        // submit 5 comments
        factory(Comment::class, 5)->create([
            'user_id' => factory(User::class),
            'post_id' => $post
        ]);
        // unrelated comments
        factory(Comment::class, 3)->create([
            'user_id' => factory(User::class),
            'post_id' => factory(Post::class)->create(
                ['user_id' => factory(User::class)]
            )
        ]);

        $this->assertEquals(5, $post->comments()->count());
    }

    /** @test */
    public function does_post_get_its_hashtags()
    {
        $post = factory(Post::class)->create([
            'user_id' => factory(User::class)
        ]);

        $hashtags = factory(Hashtag::class, 5)->create();
        // unrelated hashtags
        factory(Hashtag::class, 3)->create();


        foreach ($hashtags as $hashtag) {
            DB::table('hashtag_post')->insert(
                ['hashtag_id' => $hashtag->id, 'post_id' => $post->id]
            );
        }

        $this->assertEquals(5, $post->hashtags()->count());
    }

    /** @test */
    public function does_post_get_its_likes()
    {
        $post = factory(Post::class)->create([
            'user_id' => factory(User::class),
        ]);
        // users who are going to like the post
        $users = factory(User::class, 5)->create();

        // other users
        factory(User::class, 3)->create();

        // users like the post
        foreach ($users as $user) {
            DB::table('user_post_like')->insert(
                ['user_id' => $user->id, 'post_id' => $post->id]
            );
        }

        $this->assertEquals(5, $post->likes()->count());
    }
}
