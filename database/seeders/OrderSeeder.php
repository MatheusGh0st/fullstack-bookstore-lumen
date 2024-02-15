<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $status = ["Pending",
            "Completed", "Shipped", "Cancelled",
            "Declined", "Refunded", "Disputed"];

        for ($i = 1; $i < 20; $i++)
        {
            DB::table('orders')->insert([
                'customer_id' => $faker->randomDigit(),
                'card_id' => $faker->randomDigit(),
                'payment_id' => $faker->randomDigit(),
                'quantity' => $faker->randomDigit(),
                'order_date' => $faker->date,
                'address' => $faker->address,
                'status' => $faker->randomElement($status),
            ]);
        }
    }
}
