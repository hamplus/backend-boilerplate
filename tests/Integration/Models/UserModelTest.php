<?php

namespace Tests\Integration\Models;

use App\Hamsaa\Constants\FollowActions;
use App\Hamsaa\Constants\RelationshipStatus;
use App\Models\Comment;
use App\Models\Device;
use App\Models\Organization;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function does_user_get_all_posts_that_she_liked()
    {
        $user = factory(User::class)->create();
        $posts = factory(Post::class, 5)->create(['user_id' => factory(User::class)]);

        factory(Post::class, 2)->create(['user_id' => factory(User::class)]);

        foreach ($posts as $post) {
            DB::table('user_post_like')->insert(
                ['user_id' => $user->id, 'post_id' => $post->id]
            );
        }

        $this->assertEquals(5, $user->postLikes()->count());
    }

    /** @test */
    public function does_user_get_all_comments_that_she_liked()
    {
        $user = factory(User::class)->create();
        $comments = factory(Comment::class, 5)->create([
            'user_id' => factory(User::class),
            'post_id' => factory(Post::class)->create(
                [
                    'user_id' => factory(User::class),
                ]
            )
        ]);

        factory(Comment::class, 2)->create([
            'user_id' => factory(User::class),
            'post_id' => factory(Post::class)->create(
                [
                    'user_id' => factory(User::class),
                ]
            )
        ]);

        foreach ($comments as $comment) {
            DB::table('user_comment_like')->insert(
                ['user_id' => $user->id, 'comment_id' => $comment->id]
            );
        }

        $this->assertEquals(5, $user->commentLikes()->count());
    }

    /** @test */
    public function does_to_thumbnail_return_thumbnail_fields()
    {
        $user = factory(User::class)->create([
            'username' => 'username',
            'image' => 'profiles/user.jpg',
            'name' => 'name'
        ]);
        $this->assertEquals(
            ['username' => 'username', 'image_url' => $user->image_url, 'name' => 'name'],
            $user->toThumbnail()
        );
    }

    /** @test */
    public function does_image_url_attribute_return_image_url_when_has_image()
    {
        $user = factory(User::class)->create(['image' => 'profiles/user.jpg']);
        $this->assertEquals(
            Storage::url($user->image),
            $user->image_url
        );
    }

    /** @test */
    public function does_image_url_attribute_return_null_when_has_no_image()
    {
        $user = factory(User::class)->create(['image' => null]);
        $this->assertNull(
            $user->image_url
        );
    }
}
