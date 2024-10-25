<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('colors')->insert([
            [ 'name' => '#FF0000', 'created_at' => '2024-10-01 03:00:00', 'updated_at' => '2024-10-01 03:05:00'],
            ['name' => '#00FF00', 'created_at' => '2024-10-02 04:00:00', 'updated_at' => '2024-10-02 04:10:00'],
            [ 'name' => '#0000FF', 'created_at' => '2024-10-03 05:00:00', 'updated_at' => '2024-10-03 05:05:00'],
            [ 'name' => '#FFFFFF', 'created_at' => '2024-10-04 06:00:00', 'updated_at' => '2024-10-04 06:10:00'],
            [ 'name' => '#000000', 'created_at' => '2024-10-05 07:00:00', 'updated_at' => '2024-10-05 07:15:00'],
        ]);
    }
}
