<?php

namespace Database\Factories;

use App\Model;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $status = ["Pending",
            "Completed", "Shipped", "Cancelled",
            "Declined", "Refunded", "Disputed"];

    	return [
            'customer_id' => $this->faker->randomDigit(),
            'card_id' => $this->faker->randomDigit(),
            'payment_id' => $this->faker->randomDigit(),
            'quantity' => $this->faker->randomDigit(),
            'order_date' => $this->faker->date,
            'address' => $this->faker->address,
            'status' => $this->faker->randomElement($status),
    	];
    }
}
