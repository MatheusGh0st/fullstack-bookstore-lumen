<?php

namespace Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use TestCase;

class AuthControllerTest extends TestCase
{
    public function testUserRegistrationSuccess()
    {
        // Arrange
        $userData = User::factory()->raw([
            'firstName' => "TestUser",
            'lastName' => "LastUser",
            'email' => "testuser@gmail.com",
            'city_id' => "1",
            'user_address' => "Hansen Thr Kev",
            'phone_number' => "2455-3223535-3",
            'role' => "Illustrator",
            'password' => "secret123"
        ]);

        // Act
        $response = $this->post('/register', $userData);

        // Assert
        $response->assertResponseStatus(201);
    }

    public function testUserLoginSuccess() {

        // Arrange
        $user = User::factory()->create([
            'email' => 'testuser@gmail.com',
            'password' => Hash::make('secret123'),
        ]);

        $loginData = [
            "email" => $user->email,
            "password" => "secret123"
        ];

        // Act
        $response = $this->post('/login', $loginData);

        // Assert
        $response->assertResponseStatus(200);
    }
}
