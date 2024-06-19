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
        return Book::paginate(15);
    }

    public function getBookById(Request $request, $id): JsonResponse
    {
        try {
            $book = Book::query()->findOrFail($id);

            if ($book) {
                return response()->json(['data' => $book]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function getBookBySearchTerm(Request $request, $searchTerm): JsonResponse
    {
        try {
            $books = Book::query()->where('title', 'LIKE', "%$searchTerm%")->get();

            if ($books) {
                return response()->json(['data' => $books]);
            }
            return response()->json(['data' => $searchTerm]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
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

    public function getBookByGenre(Request $request, $genre): JsonResponse
    {
        try {
            $genreFinal = $genre;
            if (str_contains($genre, "%20")) {
                $genreAux = explode("%20", $genre);
                $genreFinal = $genreAux[0] . " " . $genreAux[1];
            }
            $bookByGenre = Book::where('genre', '=', "$genreFinal")->get();

            if ($bookByGenre)
            {
                return response()->json(['message' => 'Books genre find successfully', 'data' => $bookByGenre]);
            }
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
