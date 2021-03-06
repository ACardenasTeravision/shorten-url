<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShortenedUrl extends Model
{
    protected $fillable = ['url', 'code', 'shortened_url', 'title', 'times_visited'];
}
