<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->label('Tên người dùng')
                ->required(),
            
            TextInput::make('email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),

            TextInput::make('password')
                ->label('Mật khẩu mới')
                ->password()
                ->helperText('Để trống nếu không muốn đổi')
                // Logic quan trọng: Chỉ lưu mật khẩu nếu có nhập dữ liệu
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create'),

            Select::make('roles')
                ->label('Vai trò')
                ->relationship('roles', 'name') // Cấp quyền Admin tại đây
                ->multiple()
                ->preload(),
        ]);
    }
}
