<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'image',
        'trailer_url',
    ];

    // Quan hệ Many-to-Many với Category
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
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