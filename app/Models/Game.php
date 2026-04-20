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
    
    protected $casts = [
        'description' => 'array',
    ];

    // Quan hệ Many-to-Many với Category
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_game');
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

    public function getYoutubeIdAttribute()
    {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $this->trailer_url, $match);
        return $match[1] ?? null;
    }
}