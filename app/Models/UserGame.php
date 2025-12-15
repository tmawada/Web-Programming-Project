<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGame extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'game_id',
        'order_id',
        'purchased_at',
    ];

    protected $casts = [
        'purchased_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
