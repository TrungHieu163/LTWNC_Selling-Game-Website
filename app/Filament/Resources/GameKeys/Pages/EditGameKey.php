<?php

namespace App\Filament\Resources\GameKeys\Pages;

use App\Filament\Resources\GameKeys\GameKeyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGameKey extends EditRecord
{
    protected static string $resource = GameKeyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
