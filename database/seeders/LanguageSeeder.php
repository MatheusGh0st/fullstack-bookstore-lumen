<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $languages = ['Chinese', 'Arabic', 'Bengali', 'Russian', 'Japanese', 'Javanese',
            'German', 'Korean', 'Telugu', 'Vietnamese', 'Marathi',
            'Tamil', 'Urdu', 'Turkish', 'Italian', 'Persian', 'Thai', 'Gujarati',
            'Jin', 'Southern Min', 'Polish', 'Pashto', 'Kannada', 'Xiang', 'Malayalam', 'Sundanese', 'Hausa'];

        for ($i = 1; $i < 20; $i++)
        {
            DB::table('languages')->insert([
                'language_name' => $faker->randomElement($languages),
            ]);
        }
    }
}
