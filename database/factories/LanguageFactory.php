<?php

namespace Database\Factories;

use App\Model;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    protected $model = Language::class;

    public function definition(): array
    {
        $languages = ['Chinese', 'Arabic', 'Bengali', 'Russian', 'Japanese', 'Javanese',
            'German', 'Korean', 'Telugu', 'Vietnamese', 'Marathi',
            'Tamil', 'Urdu', 'Turkish', 'Italian', 'Persian', 'Thai', 'Gujarati',
            'Jin', 'Southern Min', 'Polish', 'Pashto', 'Kannada', 'Xiang', 'Malayalam', 'Sundanese', 'Hausa'];

    	return [
    	    'language_name' => $this->faker->randomElement($languages),
    	];
    }
}
