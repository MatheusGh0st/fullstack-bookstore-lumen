<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Mockery\Exception;

class CityController extends Controller
{
    public function index()
    {
        return City::all();
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $fields = $request->only(['city_name', 'country_id']);

            $newCity = new City();
            $newCity->fill([
                'city_name' => $fields['city_name'],
                'country_id' => $fields['country_id'],
            ]);

            if ($newCity->save()) {
                return response()->json(['message' => 'city added successfully']);
            }

            return response()->json(['error' => 'city not added']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $fields = $request->input();
        try {
            $city = City::query()->findOrFail($id);
            $city->update([
               'city_name' => $fields['city_name'],
                'country_id' => (isset($fields['country_id'])) ? $fields['country_id'] : $city->get('country_id'),
            ]);

            if ($city->save())
            {
                return response()->json(['message' => 'city update successfully']);
            }

            return response()->json(['error' => 'city not update successfully']);
        } catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            $city = City::query()->findOrFail($id);

            if ($city->delete())
            {
                return response()->json(['message' => 'city deleted successfully']);
            }

            return response()->json(['error' => 'city not deleted successfully']);
        } catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
