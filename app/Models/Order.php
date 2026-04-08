<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];
}
