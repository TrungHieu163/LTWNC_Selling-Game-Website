<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Tên người dùng')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                // Yêu cầu của bạn: Hiển thị mật khẩu bằng dấu chấm
                TextColumn::make('password')
                    ->label('Mật khẩu')
                    ->formatStateUsing(fn () => '••••••••'),

                TextColumn::make('roles.name')
                    ->label('Vai trò')
                    ->badge()
                    ->color('info'),

                TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ]);
    }
}
