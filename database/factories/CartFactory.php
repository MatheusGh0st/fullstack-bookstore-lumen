<?php

namespace Database\Factories;

use App\Model;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition(): array
    {
    	return [
    	    'user_id' => $this->faker->randomDigit(),
            'book_id' => $this->faker->randomDigit(),
            'total_books' => $this->faker->randomDigit(),
            'total_price' => $this->faker->randomFloat(2, 1, 10000),
            'discount' => $this->faker->randomFloat(0, 1, 100),
    	];
    }
}
