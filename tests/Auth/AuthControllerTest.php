<?php

namespace Auth;

use App\Models\User;
use TestCase;

class AuthControllerTest extends TestCase
{
    public function testUserRegistrationSuccess()
    {
        // Arrange
        $userData = User::factory()->raw([
            'firstName' => 'TestUser',
            'lastName' => 'LastUser',
            'email' => 'testuser@gmail.com',
            'city_id' => '1',
            'user_address' => "Hansen Thr Kev",
            'phone_number' => '2455-3223535-3',
            'role' => "Illustrator",
            'password' => 'secret123'
        ]);

        // Act
        $response = $this->post('/register', $userData);

        // Assert
        $response->assertResponseStatus(201);
    }
}
