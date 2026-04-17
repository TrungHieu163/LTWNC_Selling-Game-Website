<?php

namespace App\Filament\Resources\Games\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GamesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // ĐÃ SỬA: Đổi từ 'category.name' sang 'categories.name'
                TextColumn::make('categories.name')
                    ->label('Thể loại')
                    ->badge() // Hiển thị dạng nhãn (badge)
                    ->color('success') // Màu xanh cho nhãn
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Tên Game')
                    ->searchable(),

                TextColumn::make('slug')
                    ->searchable(),

                TextColumn::make('price')
                    ->label('Giá')
                    ->money('VND') // Thêm đơn vị tiền tệ nếu cần
                    ->sortable(),

                ImageColumn::make('image')
                    ->label('Hình ảnh'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([ // Đổi từ recordActions sang actions (chuẩn Filament v3)
                EditAction::make(),
            ])
            ->bulkActions([ // Đổi từ toolbarActions sang bulkActions cho đúng chức năng chọn nhiều
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}