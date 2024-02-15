<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = ["Pending",
            "Completed", "Shipped", "Cancelled",
            "Declined", "Refunded", "Disputed"];

        $payment_method =  ['Canceled_Reversal','Completed', 'Created', 'Denied',
            'Expired', 'Failed', 'Pending', 'Refunded', 'Reversed', 'Processed', 'Voided'];

        $faker = Factory::create();

        for ($i = 1; $i < 20; $i++)
        {
            DB::table('payments')->insert([
                'customer_id' => $faker->randomDigit(),
                'order_id' => $faker->randomDigit(),
                'status' => $faker->randomElement($status),
                'payment_method' => $faker->randomElement($payment_method),
            ]);
        }
    }
}
