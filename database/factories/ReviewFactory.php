<?php

namespace Database\Factories;

use App\Model;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
    	return [
            'customer_id' => $this->faker->randomDigit(),
            'review_book_id' => $this->faker->randomDigit(),
            'review' => $this->faker->text,
    	];
    }
}
