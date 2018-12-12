<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use SoftDeletes;

    protected $fillable = [
        'phone',
        'username',
        'name',
        'image',
        'bio',
        'bio_url',
        'is_public',
        'birthday',
        'email',
        'gender',
        'city',
        'province',
        'education',
        'skills',
        'interests'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'birthday'
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function posts()
    {
        return $this->profilePosts();
    }

    public function postLikes()
    {
        return $this->belongsToMany(Post::class, 'user_post_like')->withPivot(['created_at', 'updated_at']);
    }

    public function commentLikes()
    {
        return $this->belongsToMany(Comment::class, 'user_comment_like')->withPivot(['created_at', 'updated_at']);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function toThumbnail()
    {
        return [
            'username' => $this->username,
            'name' => $this->name,
            'image_url' => $this->image_url
        ];
    }

    public function getImageUrlAttribute(): ?string
    {
        if ($this->image !== null) {
            return Storage::url($this->image);
        }
        return null;
    }
}
