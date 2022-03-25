<?php

namespace Kilobyteno\LaravelUserGuestLike\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Kilobyteno\LaravelUserGuestLike\Traits\HasUserGuestLike;

class TestModel extends Model
{
    use HasUserGuestLike;
    protected $table = 'posts';
    protected $guarded = [];
}
