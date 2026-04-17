<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Thêm dòng này để hiểu class User
use Spatie\Permission\Models\Role; // Thêm dòng này để hiểu class Role
use Illuminate\Support\Facades\Hash; // Thêm dòng này để mã hóa mật khẩu

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo Role (Dùng firstOrCreate để tránh lỗi nếu Role đã tồn tại)
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        // Tạo User Admin
        $user = User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Kiểm tra theo email này
            [
                'name' => 'Admin User',
                'password' => Hash::make('12345678'), // Dùng Hash thay vì bcrypt cho bảo mật cao hơn
            ]
        );

        // Gán quyền
        $user->assignRole($adminRole);
    }
}