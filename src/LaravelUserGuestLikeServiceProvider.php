<?php

namespace Kilobyteno\LaravelUserGuestLike;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelUserGuestLikeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-user-guest-like')
            ->hasConfigFile('user-guest-like')
            ->hasMigration('create_user_guest_like_table');
    }
}
