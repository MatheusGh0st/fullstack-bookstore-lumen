<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Mockery\Exception;

class LanguageController extends Controller
{
    public function index()
    {
        return Language::all();
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $field = $request->input();

            $language = new Language();
            $language->fill([
               'language_name' => $field['language_name']
            ]);

            if ($language->save())
            {
                return response()->json(['message' => 'Language created successfully']);
            }

            return response()->json(['error' => 'Language not created']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $field = $request->input();

            $language = Language::query()->findOrFail($id);
            $language->update([
                'language_name' => $field['language_name']
            ]);

            if ($language->save())
            {
                return response()->json(['message' => 'Language update successfully']);
            }

            return response()->json(['error' => 'Language not update']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            $field = $request->input();

            $language = Language::query()->findOrFail($id);

            if ($language->delete())
            {
                return response()->json(['message' => 'Language deleted successfully']);
            }

            return response()->json(['error' => 'Language not deleted']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
