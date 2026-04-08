<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\Category;

class GameSeeder extends Seeder
{
    public function run()
    {
        $category = Category::create([
            'name' => 'Action'
        ]);

        Game::create([
            'name' => 'GTA V',
            'price' => 500000,
            'category_id' => $category->id
        ]);

        Game::create([
            'name' => 'FIFA 24',
            'price' => 700000,
            'category_id' => $category->id
        ]);
    }
}
