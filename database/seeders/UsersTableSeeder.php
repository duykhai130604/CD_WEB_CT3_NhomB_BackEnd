<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         // Tạo user
         User::create([
            'name' => 'Duy Khải',
            'email' => 'doduykhai1306@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
        ]);

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
