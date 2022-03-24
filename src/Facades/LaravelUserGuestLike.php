<?php

namespace Kilobyteno\LaravelUserGuestLike\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kilobyteno\LaravelUserGuestLike\LaravelUserGuestLike
 */
class LaravelUserGuestLike extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-user-guest-like';
    }
}
