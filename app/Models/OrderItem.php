<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'game_id',
        'quantity',
        'price'
    ];

    // Một chi tiết mặt hàng thuộc về một đơn hàng
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // Một chi tiết mặt hàng liên kết với một Game
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}