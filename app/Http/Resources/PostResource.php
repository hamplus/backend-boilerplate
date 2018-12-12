<?php

namespace App\Http\Resources;

use App\Hamsaa\Libraries\Formatters\DateFormatter;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->uuid,
            'user' => new ThumbnailResource($this->getUser()),
            'text' => $this->text,
            'date' => (new DateFormatter($this->created_at))->format(),
            'image_url' => $this->image_url,
            'comment_count' => $this->comments()->count(),
            'like_count' => $this->likes()->count(),
            'is_liked' => $this->isLikedBy(auth()->user()),
            'is_anonymous' => $this->is_anonymous
        ];
    }

    /**
     * Only if the post is anonymous and the auth user owns the post, user is exposed
     */
    private function getUser(): ?User
    {
        return $this->owner->is(auth()->user()) ? $this->owner : $this->user;
    }
}
