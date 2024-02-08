<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    protected $model = Author::class;

    public function definition(): array
    {
    	return [
            'author_name' => $this->faker->name,
            'authors_book_id' => $this->faker->randomDigit(),
            'description' => $this->faker->text,
            'photo' => $this->faker->image,
            'date_of_birth' => $this->faker->date,
    	];
    }
}
