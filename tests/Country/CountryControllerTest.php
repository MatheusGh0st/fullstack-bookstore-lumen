<?php

namespace Country;

use App\Models\Country;
use PHPUnit\Exception;
use TestCase;

class CountryControllerTest extends TestCase
{
    public function testReturnAllCountries()
    {
        $token = getenv('AUTH_TOKEN');

        try {
            $response = $this->get('/countries', [
                'auth_bearer' => $token
            ]);

            $response->assertResponseStatus(200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function testCountriesCreatedSuccessfully()
    {
        $token = getenv('AUTH_TOKEN');

        $country = Country::query()->create(Country::factory()->make()->getAttributes());

        $payload = [
            'country_name' => $country->country_name
        ];

        try {
            $response = $this->post('/country', $payload, [
                'auth_bearer' => $token
            ]);

            $response->assertResponseStatus(201);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function testDestroyCountry()
    {
        $token = getenv('AUTH_TOKEN');

        $countryAttributes = Country::factory()->make()->getAttributes();
        $country = Country::query()->create($countryAttributes);

        try {
            $response = $this->post("/city/$country->id", [], [
                'auth_bearer' => $token
            ]);

            $response->assertResponseStatus(200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
