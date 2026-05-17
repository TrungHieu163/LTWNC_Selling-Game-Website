<?php

namespace App\Filament\Widgets;

use App\Models\Game;
use App\Models\GameKey;
use Filament\Widgets\ChartWidget;

class SalesPieChart extends ChartWidget
{
    protected ?string $heading = 'Tỷ trọng doanh thu theo Game (%)';
    protected int | string | array $columnSpan = 1;
    protected static ?int $sort = 3;
    protected function getData(): array
    {
        $games = Game::all();
        $labels = [];
        $dataset = [];

        foreach ($games as $game) {
            $soldKeysCount = GameKey::where('game_id', $game->id)
                                    ->where('is_sold', 1)
                                    ->count();
            $revenue = $soldKeysCount * $game->price;

            if ($revenue > 0) {
                $labels[] = $game->name;
                $dataset[] = $revenue;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Doanh thu',
                    'data' => $dataset,
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'pie'; // Chế độ biểu đồ tròn
    }
}