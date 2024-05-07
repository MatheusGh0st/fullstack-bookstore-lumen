<?php

namespace City;

use App\Models\City;
use PHPUnit\Exception;
use TestCase;

class CityControllerTest extends TestCase
{
    public function testCityReturnAll()
    {
        $token = getenv('AUTH_TOKEN');

        try {
            $response = $this->get('/cities', [
                'auth_bearer' => $token,
            ]);

            $response->assertResponseStatus(200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function testCitiesIsCreatedSuccessfully()
    {
        $token = getenv('AUTH_TOKEN');

        $city = City::query()->create(City::factory()->make()->getAttributes());

        $payload = [
            'city_name' => $city->city_name,
            'country_id' => random_int(0, 10)
        ];

        try {
            $response = $this->post('/city', $payload, [
                'auth_bearer' => $token,
            ]);

            $response->assertResponseStatus(200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function testDestroyCity()
    {
        $token = getenv('AUTH_TOKEN');

        $cityAttributes = City::factory()->make()->getAttributes();
        $city = City::query()->create($cityAttributes);

        try {
            $response = $this->post("/city/$city->id", [], [
                'auth_bearer' => $token
            ]);

            $response->assertResponseStatus(200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
