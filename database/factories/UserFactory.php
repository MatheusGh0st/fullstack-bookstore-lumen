<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $roles = ['Author', 'Editor', 'Publisher', 'Illustrator', 'Translator'];

        return [
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'city_id' => $this->faker->randomDigit(),
            'user_address' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'role' => $this->faker->randomElement($roles),
            'password' => Hash::make('secret123'),
        ];
    }
}
