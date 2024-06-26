<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    protected $model = City::class;

    public function definition()
    {
        return [
            'city_name' => $this->faker->city,
            'country_id' => $this->faker->randomNumber(1)
        ];
    }
}
