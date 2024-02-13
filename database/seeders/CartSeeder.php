<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 1; $i < 20; $i++)
        {
            DB::table('carts')->insert([
                'user_id' => $faker->randomDigit(),
                'book_id' => $faker->randomDigit(),
                'total_books' => $faker->randomDigit(),
                'total_price' => $faker->randomFloat(2, 1, 10000),
                'discount' => $faker->randomFloat(0, 1, 100),
            ]);
        }
    }
}
