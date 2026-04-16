<?php

namespace App\Filament\Resources\GameKeys;

use App\Filament\Resources\GameKeys\Pages\CreateGameKey;
use App\Filament\Resources\GameKeys\Pages\EditGameKey;
use App\Filament\Resources\GameKeys\Pages\ListGameKeys;
use App\Filament\Resources\GameKeys\Schemas\GameKeyForm;
use App\Filament\Resources\GameKeys\Tables\GameKeysTable;
use App\Models\GameKey;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GameKeyResource extends Resource
{
    protected static ?string $model = GameKey::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'key_code';

    public static function form(Schema $schema): Schema
    {
        return GameKeyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GameKeysTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGameKeys::route('/'),
            'create' => CreateGameKey::route('/create'),
            'edit' => EditGameKey::route('/{record}/edit'),
        ];
    }
}
