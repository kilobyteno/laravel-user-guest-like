<?php

namespace Kilobyteno\LaravelUserGuestLike\Tests\Models;

use Illuminate\Database\Eloquent\Model;

class TestAuthorModel extends Model
{
    protected $table = 'users';
    protected $guarded = [];
}
