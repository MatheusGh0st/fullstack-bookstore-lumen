<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
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
            DB::table('authors')->insert([
                'author_name' => $faker->name,
                'authors_book_id' => $faker->randomDigit(),
                'description' => $faker->text,
                'photo' => $faker->image,
                'date_of_birth' => $faker->date,
            ]);
        }
    }
}
