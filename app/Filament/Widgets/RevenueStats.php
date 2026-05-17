<?php

namespace App\Filament\Widgets;

use App\Models\Game;
use App\Models\GameKey;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RevenueStats extends BaseWidget
{
    protected int | string | array $columnSpan = 1;
    protected static ?int $sort = 1;
    protected function getColumns(): int
    {
        return 1;
    }
    protected function getStats(): array
    {
        // Tính tổng doanh thu: sum (giá game * số key đã bán của game đó)
        $totalRevenue = Game::all()->reduce(function ($carry, $game) {
            $soldKeysCount = GameKey::where('game_id', $game->id)
                                    ->where('is_sold', 1) // Dựa trên cột is_sold trong DB
                                    ->count();
            return $carry + ($soldKeysCount * $game->price);
        }, 0);

        return [
            Stat::make('Tổng doanh thu', number_format($totalRevenue, 0, ',', '.') . ' VNĐ')
                ->description('Dựa trên số key đã bán thực tế')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            
            Stat::make('Tổng Key đã bán', GameKey::where('is_sold', 1)->count())
                ->icon('heroicon-m-shopping-cart'),
        ];
    }
}