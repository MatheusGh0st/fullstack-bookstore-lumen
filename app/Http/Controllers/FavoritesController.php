<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class FavoritesController extends Controller
{
    public function index()
    {
        return Favorite::all();
    }

    public function getAllFavoritesByUser(Request $request, $id): Json Response
    {
        try {
            $favorites = Favorites::query()->where('user_id'. '=', $id)->get();

            if (!$favorites) {
                return response()->json(['message' => 'Not found favorites associate with this userId']);
            }

            return response()->json(['message' => 'Favorites finds successfully', 'data' => $favorites]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function store(Request request): JsonResponse
    {
        try {
            $field = $request->input();

            $favorite = new Favorite();
            $favorite->fill([
                'user_id' => $field['user_id'],
                'book_id' => $field['book_id'],
            ]);

            if ($favorite->save())
            {
                return response()->json(['message' => 'Favorite add successfully']);
            }

            return response()->json(['error' => 'error during add favorite']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $field = $request->input();

            $favorite = Favorite::query()->findOrFail($id);
            $favorite->update([
                'user_id' => $field['user_id'],
                'book_id' => $field['book_id'],
            ]);

            if ($favorite->save())
            {
                return response()->json(['message' => 'Favorite update successfully']);
            }

            return response()->json(['error' => 'Favorite not update']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            $field = $request->input();

            $favorite = Favorite::query()->findOrFail($id);

            if ($language->delete())
            {
                return response()->json(['message' => 'Favorite deleted successfully']);
            }

            return response()->json(['error' => 'Favorite not deleted']);
        } catch () {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
