<?php

namespace Database\Factories;

use App\Model;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        $status = ['Available', 'Not Available'];
        $genre = ['Action', 'Adventure', 'Classics', 'Comic Book', 'Graphic Novel',
            'Detective', 'Mystery', 'Fantasy', 'Historical Fiction', 'Horror', 'Literary Fiction',
            'Romance', 'Science Fiction', 'Suspense', 'Thrillers', 'Fiction'];

    	return [
            'title' => $this->faker->sentence(),
            'books_language_foreign' => $this->faker->randomDigit(),
            'publication_date' => $this->faker->date,
            'author_id' => $this->faker->randomDigit(),
            'price' => $this->faker->randomFloat(0, 1000),
            'image' => $this->faker->image,
            'edition' => $this->faker->randomDigit(1, 10),
            'status' => $this->faker->randomElement($status),
            'stock' => $this->faker->randomDigit(0, 1000),
            'genre' => $this->faker->randomElement($genre),
    	];
    }
}
