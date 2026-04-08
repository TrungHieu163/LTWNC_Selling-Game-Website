<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function keys() {
        return $this->hasMany(GameKey::class);
    }
}
