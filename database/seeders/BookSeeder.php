<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $status = ['Available', 'Not Available'];
        $genre = ['Action', 'Adventure', 'Classics', 'Comic Book', 'Graphic Novel',
            'Detective', 'Mystery', 'Fantasy', 'Historical Fiction', 'Horror', 'Literary Fiction',
            'Romance', 'Science Fiction', 'Suspense', 'Thrillers', 'Fiction'];

        for ($i = 1; $i < 20; $i++)
        {
            DB::table('books')->insert([
                'title' => $faker->sentence(),
                'books_language_foreign' => $faker->randomDigit(),
                'publication_date' => $faker->date,
                'author_id' => $faker->randomDigit(),
                'price' => $faker->randomFloat(2, 0, 300),
                'image' => $faker->image,
                'edition' => $faker->randomDigit(1, 10),
                'status' => $faker->randomElement($status),
                'stock' => $faker->randomDigit(0, 1000),
                'genre' => $faker->randomElement($genre),
            ]);
        }
    }
}
