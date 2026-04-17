<?php

namespace App\Filament\Resources\GameKeys\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GameKeyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('game_id')
                    ->relationship('game', 'name')
                    ->required(),
                TextInput::make('key_code')
                    ->required(),
                Toggle::make('is_sold')
                    ->required(),
            ]);
    }
}
