<?php

namespace App\Filament\Resources\Games\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;

class GameForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('categories') 
                    ->label('Thể loại')
                    ->relationship('categories', 'name')
                    ->multiple()
                    ->preload()
                    ->required(),

                TextInput::make('name')
                    ->required(),

                TextInput::make('slug')
                    ->required(),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('đ'),

                // PHẦN DESCRIPTION MỚI: Dạng Tabs để nhập dữ liệu mảng JSON
                Tabs::make('Chi tiết & Cấu hình Game')
                    ->tabs([
                        Tabs\Tab::make('Thông tin chung')
                            ->schema([
                                Textarea::make('description.intro')
                                    ->label('Đoạn văn giới thiệu ngắn')
                                    ->rows(3),
                                Grid::make(2)->schema([
                                    TextInput::make('description.developer')->label('Nhà phát triển (Studio)'),
                                    TextInput::make('description.publisher')->label('Nhà phát hành'),
                                    DatePicker::make('description.released_at')
                                        ->label('Ngày phát hành')
                                        ->displayFormat('d/m/Y') // Định dạng hiển thị khi chọn xong (Ví dụ: 14/04/2026)
                                        ->native(false)         // Tắt giao diện chọn ngày của trình duyệt, dùng lịch của Filament cho đẹp
                                        ->closeOnDateSelection(), // Tự động đóng lịch sau khi chọn ngày xong
                                    TextInput::make('description.features')->label('Tính năng (Ví dụ: Single-player)'),
                                ]),
                            ]),

                        Tabs\Tab::make('Cấu hình tối thiểu')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('description.min_os')->label('Hệ điều hành tối thiểu'),
                                    TextInput::make('description.min_cpu')->label('CPU tối thiểu'),
                                    TextInput::make('description.min_ram')->label('RAM tối thiểu'),
                                    TextInput::make('description.min_gpu')->label('Card đồ họa tối thiểu'),
                                ]),
                            ]),

                        Tabs\Tab::make('Cấu hình khuyến nghị')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('description.rec_os')->label('Hệ điều hành khuyến nghị'),
                                    TextInput::make('description.rec_cpu')->label('CPU khuyến nghị'),
                                    TextInput::make('description.rec_ram')->label('RAM khuyến nghị'),
                                    TextInput::make('description.rec_gpu')->label('Card đồ họa khuyến nghị'),
                                ]),
                            ]),
                    ])
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->label('Hình ảnh')
                    ->image()
                    ->disk('public') // Lưu vào storage/app/public
                    ->directory('images')
                    ->columnSpan(1),

                TextInput::make('trailer_url')
                    ->label('Link Trailer (Youtube)')
                    ->placeholder('https://www.youtube.com/watch?v=...')
                    ->url()
                    ->columnSpan(1),
            ]);
    }
}