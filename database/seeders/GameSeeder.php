<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\Category;
use Illuminate\Support\Str;

class GameSeeder extends Seeder
{
    public function run()
    {
        $action = Category::create([
            'name' => 'Action'
        ]);

        $sport = Category::create([
            'name' => 'Sport'
        ]);

        Game::create([
            'name' => 'GTA V',
            'slug' => Str::slug('GTA V'),
            'price' => 500000,
            'description' => 'Siêu phẩm hành động thế giới mở.',
            'category_id' => $action->id,
            'image' => null
        ]);

        Game::create([
            'name' => 'FIFA 24',
            'slug' => Str::slug('FIFA 24'),
            'price' => 700000,
            'description' => 'Game bóng đá đỉnh cao từ EA Sports.',
            'category_id' => $sport->id,
            'image' => null
        ]);

        Game::create([
            'name' => 'Elden Ring',
            'slug' => Str::slug('Elden Ring'),
            'price' => 1200000,
            'description' => 'Game nhập vai hành động khó nhất năm.',
            'category_id' => $action->id,
            'image' => null
        ]);
    }
}