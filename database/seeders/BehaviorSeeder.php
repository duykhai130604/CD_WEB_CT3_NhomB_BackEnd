<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Behavior;
use Faker\Factory as Faker;

class BehaviorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        for ($i = 0; $i < 1000; $i++) {
            Behavior::create([
                'user_id' => $faker->numberBetween(1, 5),
                'action' => $faker->randomElement(['click', 'follow']),
                'product_id' => $faker->numberBetween(1, 8),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => now(),
            ]);
        }
    }
}
