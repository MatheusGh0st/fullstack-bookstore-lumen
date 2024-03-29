<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CitySeeder::class,
            CountrySeeder::class,
            BookSeeder::class,
            AuthorSeeder::class,
            ReviewSeeder::class,
            LanguageSeeder::class,
            CartSeeder::class,
            OrderSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
