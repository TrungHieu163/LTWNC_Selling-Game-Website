<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use App\Models\GameKey;

class GameKeySeeder extends Seeder
{
    public function run()
    {
        $games = Game::all();

        foreach ($games as $game) {
            // Tạo 10 key cho mỗi game
            for ($i = 1; $i <= 10; $i++) {
                GameKey::create([
                    'game_id' => $game->id,
                    'key_code' => strtoupper(uniqid('KEY-' . $game->id . '-')),
                    'is_sold' => false,
                ]);
            }
        }
    }
}