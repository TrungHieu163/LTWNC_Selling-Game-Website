<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với OrderItem: Một đơn hàng có nhiều chi tiết mặt hàng
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function gameKeys()
    {
        return $this->belongsToMany(GameKey::class, 'order_game_keys')
                    ->withPivot('created_at')
                    ->withTimestamps();
    }

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];
}
