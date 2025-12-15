<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'cover_image',
        'platform',
        'genre',
        'publisher',
        'release_date',
    ];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
