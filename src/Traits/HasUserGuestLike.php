<?php

namespace Kilobyteno\LaravelUserGuestLike\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Kilobyteno\LaravelUserGuestLike\Models\UserGuestLike;

trait HasUserGuestLike
{
    public function likes(): MorphMany
    {
        return $this->morphMany(UserGuestLike::class, 'model', 'model_type', 'model_id')->latest('id');
    }

    /**
     * @param Model|null $author
     * @return $this
     */
    public function like(?Model $author = null): self
    {
        return $this->createLike($author);
    }

    private function createLike($author)
    {
        if ($author) {
            $ip = $this->userTrackingEnabled() ? request()->ip() : null;
            $userAgent = $this->userTrackingEnabled() ? request()->userAgent() : null;

            $keyName = $author->getKeyName();
            $this->likes()->create([
                'author_id' => $author->$keyName,
                'author_type' => $author->getMorphClass(),
                'ip' => $ip,
                'user_agent' => $userAgent,
            ]);
        } elseif ($this->guestLikeEnabled()) {
            $ip = request()->ip();
            $userAgent = request()->userAgent();

            $this->likes()->create([
                'ip' => $ip,
                'user_agent' => $userAgent,
            ]);
        }

        return $this;
    }

    public function hasLiked(?Model $author = null): bool
    {
        if ($author) {
            $keyName = $author->getKeyName();
            return $this->likes()
                ->where('author_id', $author->$keyName)
                ->where('author_type', $author->getMorphClass())
                ->count() > 0;
        } elseif ($this->guestLikeEnabled() && ($ip = request()->ip()) && ($userAgent = request()->userAgent())) {
            return $this->likes()->forIp($ip)->forUserAgent($userAgent)->count() > 0;
        }

        return false;
    }

    public function dislike(?Model $author = null): bool
    {
        if ($author) {
            $keyName = $author->getKeyName();
            return $this->likes()
                ->where('author_id', $author->$keyName)
                ->where('author_type', $author->getMorphClass())
                ->delete();
        } elseif (($ip = request()->ip()) && ($userAgent = request()->userAgent())) {
            return $this->likes()->forIp($ip)->forUserAgent($userAgent)->delete();
        }

        return false;
    }

    public function guestLikeEnabled(): bool
    {
        return config('user-guest-like.guest_like_enabled', true);
    }

    public function userTrackingEnabled(): bool
    {
        return config('user-guest-like.user_tracking_enabled', false);
    }
}
