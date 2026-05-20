<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Select::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'pending' => 'Chờ thanh toán',
                        'completed' => 'Thành công',
                        'failed' => 'Thất bại',
                    ])
                    ->required()
                    ->native(false),
            ]);
    }
}
