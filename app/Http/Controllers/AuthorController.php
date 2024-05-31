<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use PHPUnit\Exception;
use Psy\Util\Json;

class AuthorController extends Controller
{
    public function index()
    {
        return Author::all();
    }

    public function getAuthorById(Request $request, $id)
    {
        try {
            $author = Author::query()->findOrFail($id);

            if (!$author) {
                return response()->json(['message' => 'Not found Author with this Id']);
            }
            return response()->json(['message' => 'Author finds successfully', 'data' => $author]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $fields = $request->input();

            $author = new Author();
            $author->fill([
               'author_table_id' => $fields['author_table_id'],
               'authors_book_id' => $fields['authors_book_id'],
               'author_name' => $fields['author_name'],
               'description' => $fields['description'],
               'photo' => $fields['photo'],
               'date_of_birth' => $fields['date_of_birth'],
            ]);

            if ($author->save())
            {
                return response()->json(['message' => 'Author created successfully']);
            }

            return response()->json(['error' => 'Author not created successfully']);
        } catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $fields = $request->input();

            $author = Author::query()->findOrFail($id);
            $author->update([
                'author_table_id' => $fields['author_table_id'],
                'authors_book_id' => $fields['authors_book_id'],
                'author_name' => $fields['author_name'],
                'description' => $fields['description'],
                'photo' => $fields['photo'],
                'date_of_birth' => $fields['date_of_birth'],
            ]);

            if ($author->save())
            {
                return response()->json(['message' => 'Author update successfully']);
            }

            return response()->json(['message' => 'Author not update']);
        } catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            $author = Author::query()->findOrFail($id);

            if ($author->delete())
            {
                return response()->json(['message' => 'Author deleted successfully']);
            }

            return response()->json(['error' => 'Author not deleted.']);
        } catch (Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
