<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlShortener extends Model
{
    use HasFactory;

    protected $table = 'url_shorteners';
    protected $fillable = ['url', 'short_url', 'counter'];
}
