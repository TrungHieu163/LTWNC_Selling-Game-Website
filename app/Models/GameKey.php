<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameKey extends Model
{
    protected $fillable = [
        'game_id',
        'key_code',
        'is_sold',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
