<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            SizesTableSeeder::class,
            ColorsTableSeeder::class,
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            ProductCategoryTableSeeder::class,
            ProductVariantsTableSeeder::class,
            ProductImagesTableSeeder::class,
            OrdersTableSeeder::class,
            ReviewsTableSeeder::class,
            CartsTableSeeder::class,
            ProductOrderTableSeeder::class,
            CommentsTableSeeder::class,
            BlogsTableSeeder::class,
            UsersTableSeeder::class
        ]);
    }
}
