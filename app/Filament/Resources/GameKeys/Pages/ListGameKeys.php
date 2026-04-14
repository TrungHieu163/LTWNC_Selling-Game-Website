<?php

namespace App\Filament\Resources\GameKeys\Pages;

use App\Filament\Resources\GameKeys\GameKeyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGameKeys extends ListRecords
{
    protected static string $resource = GameKeyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
