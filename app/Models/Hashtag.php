<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hashtag extends Model
{
    use SoftDeletes;

    protected $fillable = ['text'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function comments()
    {
        return $this->belongsToMany(Comment::class);
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
    }
}
