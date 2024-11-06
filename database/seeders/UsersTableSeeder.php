<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /*
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo 10 admin
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'Admin ' . $i,
                'email' => 'admin' . $i . '@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]);
        }

        // Tạo 10 user không có quyền admin
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@gmail.com',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]);
        }
        // Tạo admin
        User::create([
            'name' => 'Duy Khải Admin',
            'email' => 'doduykhai1306.azure@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);
        
        User::create([
            'name' => 'nhannguyen',
            'email' => 'nguyenphucthiennhan3358@gmail.com',
            'password' => Hash::make('nhan3358@'),
            'role' => 'admin',
        ]);
        
    }
}
