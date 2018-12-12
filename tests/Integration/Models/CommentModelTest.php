<?php

namespace Tests\Integration\Models;

use App\Models\Comment;
use App\Models\Hashtag;
use App\Models\Post;
use App\Models\User;
use DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function does_comment_get_its_user()
    {
        $user = factory(User::class)->create();
        $comment = factory(Comment::class)->create(
            [
                'user_id' => $user->id,
                'post_id' => factory(Post::class)->create(
                    [
                        'user_id' => factory(User::class)]
                )
            ]
        );
        $this->assertEquals($user->id, $comment->user->id);
    }

    /** @test */
    public function does_comment_get_its_post()
    {
        $post = factory(Post::class)->create(
            ['user_id' => factory(User::class)]
        );
        $comment = factory(Comment::class)->create(
            [
                'user_id' => factory(User::class),
                'post_id' => $post
            ]
        );
        $this->assertEquals($post->id, $comment->post->id);
    }

    /** @test */
    public function does_comment_get_its_hashtags()
    {
        $comment = factory(Comment::class)->create(
            [
                'user_id' => factory(User::class),
                'post_id' => factory(Post::class)->create(
                    ['user_id' => factory(User::class)]
                )
            ]
        );

        $hashtags = factory(Hashtag::class, 5)->create();

        // unrelated hashtags
        factory(Hashtag::class, 3)->create();

        foreach ($hashtags as $hashtag) {
            DB::table('comment_hashtag')->insert(
                ['hashtag_id' => $hashtag->id, 'comment_id' => $comment->id]
            );
        }
        $this->assertEquals(5, $comment->hashtags()->count());
    }


    /** @test */
    public function does_comment_get_its_likes()
    {
        $comment = factory(Comment::class)->create(
            [
                'user_id' => factory(User::class),
                'post_id' => factory(Post::class)->create(
                    ['user_id' => factory(User::class)]
                )
            ]
        );
        // users who are going to like the comment
        $users = factory(User::class, 5)->create();

        // other users
        factory(User::class, 3)->create();

        // users like the comment
        foreach ($users as $user) {
            DB::table('user_comment_like')->insert(
                ['user_id' => $user->id, 'comment_id' => $comment->id]
            );
        }

        $this->assertEquals(5, $comment->likes()->count());
    }
}
