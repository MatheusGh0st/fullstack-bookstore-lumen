<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $roles = ['Author', 'Editor', 'Publisher', 'Illustrator', 'Translator'];

        for($i = 1; $i <= 20; $i++) {
            DB::table('users')->insert([
                'city_id' => $faker->randomDigit(),
                'firstName' => $faker->firstName(),
                'lastName' => $faker->lastName(),
                'email' => $faker->email(),
                'user_address' => $faker->address(),
                'phone_number' => $faker->phoneNumber(),
                'role' => $faker->randomElement($roles),
                'password' => Hash::make('secret123'),
            ]);
        }
    }
}
