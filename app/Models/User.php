<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // Quan trọng: Thêm trait của Spatie

class User extends Authenticatable implements FilamentUser // Quan trọng: Thêm implements
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles; // Thêm HasRoles ở đây

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Quyết định ai được phép vào trang Admin
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Hiện tại cho phép tất cả để bạn đăng nhập thử.
        // Sau khi tạo xong Role 'admin', bạn nên đổi thành: return $this->hasRole('admin');
        return true; 
    }
}