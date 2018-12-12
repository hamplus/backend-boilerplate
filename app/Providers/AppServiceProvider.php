<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Observers\UuidObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Comment::observe(UuidObserver::class);
        Post::observe(UuidObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
