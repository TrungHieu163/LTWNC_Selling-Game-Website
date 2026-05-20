<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // 1. Thêm cột Mã đơn hàng (Dùng ID của đơn hàng)
                TextColumn::make('id')
                    ->label('Mã đơn hàng')
                    ->searchable()
                    ->sortable(),

                // 2. Hiển thị Tên Khách Hàng
                TextColumn::make('user.name')
                    ->label('Khách hàng')
                    ->searchable(),

                // 3. HIỂN THỊ TÊN GAME TRONG ĐƠN HÀNG
                TextColumn::make('items.game.name')
                    ->label('Game')
                    ->listWithLineBreaks()
                    ->bulleted(),

                // 4. Sửa lại tiền tệ thành VNĐ
                TextColumn::make('total_price')
                    ->label('Tổng tiền')
                    ->money('VND') 
                    ->sortable(),

                // 5. Hiển thị trạng thái
                TextColumn::make('status')
                    ->label('Trạng thái')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Chờ thanh toán',
                        'completed' => 'Thành công',
                        'failed' => 'Thất bại',
                        default => $state,
                    })
                    ->searchable(),

                // 6. Ngày đặt hàng
                TextColumn::make('created_at')
                    ->label('Ngày đặt')
                    ->dateTime('H:i d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Lọc theo trạng thái')
                    ->options([
                        'pending' => 'Chờ thanh toán',
                        'completed' => 'Thành công',
                        'failed' => 'Thất bại',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
