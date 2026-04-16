<?php

namespace App\Filament\Resources\Games\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class GameForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ĐÃ SỬA: Đổi 'category_id' thành 'categories' (tên hàm trong Model Game)
                Select::make('categories') 
                    ->label('Thể loại')
                    ->relationship('categories', 'name') // Kết nối qua bảng trung gian
                    ->multiple() // Quan trọng: Cho phép chọn nhiều thể loại
                    ->preload()  // Tải trước danh sách để chọn nhanh
                    ->required(),

                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image(),
            ]);
    }
}