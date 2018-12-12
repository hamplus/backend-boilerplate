<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['text'];

    public function getImageUrlAttribute(): ?string
    {
        if ($this->image !== null) {
            return Storage::url($this->image);
        }
        return null;
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'user_post_like')->withPivot(['created_at', 'updated_at']);
    }
}
