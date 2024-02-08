<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class BookController extends Controller
{
    public function index()
    {
        return Book::all();
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $fields = $request->input();

            $book = new Book();
            $book->fill([
                'title' => $fields['title'],
                'books_language_foreign' => $fields['books_language_foreign'],
                'publication_date' => $fields['publication_date'],
                'author_id' => $fields['author_id'],
                'price' => $fields['price'],
                'image' => $fields['image'],
                'edition' => $fields['edition'],
                'status' => $fields['status'],
                'stock' => $fields['stock'],
                'genre' => $fields['genre'],
            ]);

            if ($book->save()) {
                return response()->json(['message' => 'Book create successfully']);
            }

            return response()->json(['error' => 'Book not created successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $fields = $request->input();

            $book = new Book();
            $book->update([
                'title' => $fields['title'],
                'books_language_foreign' => $fields['books_language_foreign'],
                'author_id' => $fields['author_id'],
                'price' => $fields['price'],
                'image' => $fields['image'],
                'edition' => $fields['edition'],
                'status' => $fields['status'],
                'stock' => $fields['stock'],
                'genre' => $fields['genre'],
            ]);

            if ($book->save()) {
                return response()->json(['message' => 'Book update successfully']);
            }

            return response()->json(['error' => 'Book not update successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            $book = Book::query()->findOrFail($id);

            if ($book->delete())
            {
                return response()->json(['message' => 'Book deleted successfully']);
            }

            return response()->json(['error' => 'Book not deleted']);
        } catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
