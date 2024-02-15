<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        $status = ["Pending",
            "Completed", "Shipped", "Cancelled",
            "Declined", "Refunded", "Disputed"];

        $payment_method =  ['Canceled_Reversal','Completed', 'Created', 'Denied',
            'Expired', 'Failed', 'Pending', 'Refunded', 'Reversed', 'Processed', 'Voided'];

    	return [
            'customer_id' => $this->faker->randomDigit(),
            'order_id' => $this->faker->randomDigit(),
            'status' => $this->faker->randomElement($status),
            'payment_method' => $this->faker->randomElement($payment_method),
    	];
    }
}
