<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class CountryController
{
    public function index()
    {
        return Country::all();
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $fields = $request->only(['country_name']);

            $newCountry = new Country();
            $newCountry->fill([
                'country_name' => $fields['country_name'],
            ]);

            if ($newCountry->save()) {
                return response()->json(['message' => 'country added successfully']);
            }

            return response()->json(['error' => 'country not added']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $fields = $request->input();
        try {
            $country = Country::query()->findOrFail($id);
            $country->update([
                'country_name' => $fields['country_name'],
            ]);

            if ($country->save())
            {
                return response()->json(['message' => 'country update successfully']);
            }

            return response()->json(['error' => 'country not update successfully']);
        } catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            $country = Country::query()->findOrFail($id);

            if ($country->delete())
            {
                return response()->json(['message' => 'country deleted successfully']);
            }

            return response()->json(['error' => 'country not deleted successfully']);
        } catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
