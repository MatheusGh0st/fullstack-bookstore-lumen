<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
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
            DB::table('cities')->insert([
                'city_name' => $faker->city(),
                'country_id' => $faker->randomDigit()
            ]);
        }
    }
}
