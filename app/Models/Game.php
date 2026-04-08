<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'image',
        'category_id',
    ];

    // Quan hệ: Một Game thuộc về một Danh mục
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Quan hệ: Một Game có nhiều mã Key
    public function keys(): HasMany
    {
        return $this->hasMany(GameKey::class);
    }

    // Helper: Lấy key chưa bán
    public function availableKeys()
    {
        return $this->keys()->where('is_sold', false);
    }
}