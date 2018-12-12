<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'user_comment_like')->withPivot(['created_at', 'updated_at']);
    }

    public function reports()
    {
        return $this->belongsToMany(User::class, 'user_comment_report')->withPivot(['created_at', 'updated_at']);
    }
}
