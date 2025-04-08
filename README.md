# Laravel User Guest Like

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kilobyteno/laravel-user-guest-like.svg?style=flat-square)](https://packagist.org/packages/kilobyteno/laravel-user-guest-like)
[![Total Downloads](https://img.shields.io/packagist/dt/kilobyteno/laravel-user-guest-like.svg?style=flat-square)](https://packagist.org/packages/kilobyteno/laravel-user-guest-like)
[![Tests](https://github.com/kilobyteno/laravel-user-guest-like/actions/workflows/run-tests.yml/badge.svg)](https://github.com/kilobyteno/laravel-user-guest-like/actions/workflows/run-tests.yml)

A Laravel package to allow guests and users to like models.

## Installation

You can install the package via composer:

```bash
composer require kilobyteno/laravel-user-guest-like
```

Publish the package:

```bash
php artisan vendor:publish --provider="Kilobyteno\LaravelUserGuestLike\LaravelUserGuestLikeServiceProvider"
```

Or you can publish manually:

```bash
php artisan vendor:publish --tag="user-guest-like-config"
php artisan vendor:publish --tag="user-guest-like-migrations"
php artisan migrate
```

The content of the config file that will be published to `config/user-guest-like.php`:

```php
return [

    // Let guests like a model
    'guest_like_enabled' => true,

    // Save IP and user agent to database
    'user_tracking_enabled' => false,

];
```

## Usage

Add the `HasUserGuestLike` trait to the model:

```php
use Kilobyteno\LaravelUserGuestLike\Traits\HasUserGuestLike;
use Illuminate\Database\Eloquent\Model;

class EloquentModel extends Model
{
    use HasUserGuestLike;
}
```

Like a model as user (or guest):

```php
$user = auth()->check() ? auth()->user() : null;
// Passing the user as null will like as a guest (if enabled)
$model->like($user);
```

Dislike a model as user (or guest):

```php
$user = auth()->check() ? auth()->user() : null;
// Passing the user as null will like as a guest (if enabled)
$model->dislike($user);
```

Check if a user has liked a model (or guest has liked a model):

```php
$user = auth()->check() ? auth()->user() : null;
// Passing the user as null will check if the guest (if enabled) has liked the model
if($model->hasLiked($user)) {
    // User has liked the model
}
```

Display the number of likes for a model:

```php
$model->likes()->count();
```

## Testing

```bash
composer test
```

## Compatibility

|      | 1.0 | 1.1 | 1.2 | 1.3 | 1.4 |
|------|-----|-----|-----|-----|-----|
| 8.x  | ✅   | ❌   | ❌   | ❌   | ❌   |
| 9.x  | ❌   | ✅   | ✅   | ❌   | ❌   |
| 10.x | ❌   | ❌   | ✅   | ✅   | ❌   |
| 11.x | ❌   | ❌   | ❌   | ✅   | ✅   |
| 12.x | ❌   | ❌   | ❌   | ❌   | ✅   |

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Kilobyte AS](https://github.com/kilobyteno)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
