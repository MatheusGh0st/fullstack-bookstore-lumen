<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
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
            DB::table('reviews')->insert([
                'customer_id' => $faker->randomDigit(),
                'review_book_id' => $faker->randomDigit(),
                'review' => $faker->text,
            ]);
        }
    }
}
