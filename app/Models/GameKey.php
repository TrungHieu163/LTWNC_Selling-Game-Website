<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameKey extends Model
{
    protected $fillable = [
        'game_id',
        'order_id',
        'key_code',
        'is_sold',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'order_game_keys');
    }
}
