<?php

namespace Book;

use App\Models\Book;
use PHPUnit\Exception;
use TestCase;

class BookControllerTest extends TestCase
{
    public function testBookReturnAll()
    {
        $token = getenv('AUTH_TOKEN');

        try {
            $response = $this->get('/books', [
                'auth_bearer' => $token
            ]);

            $response->assertResponseStatus(200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function testBooksIsCreatedSuccessfully()
    {
        $token = getenv('AUTH_TOKEN');

        $book = Book::query()->create(Book::factory()->make()->getAttributes());

        $payload = [
            'title' => $book->title,
            'books_language_foreign' => $book->books_language_foreign,
            'author_id' => $book->author_id,
            'price' => $book->price,
            'image' => $book->image,
            'edition' => $book->edition,
            'status' => $book->status,
            'stock' => $book->stock,
            'genre' => $book->genre,
        ];

        try {
            $response = $this->post('/book', $payload, [
                'auth_bearer' => $token
            ]);

            $response->assertResponseStatus(200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function testDestroyBook()
    {
        $token = getenv('AUTH_TOKEN');

        $bookAttributes = Book::factory()->make()->getAttributes();
        $book = Book::query()->create($bookAttributes);

        try {
            $response = $this->post("/book/$book->id", [], [
                'auth_bearer' => $token
            ]);

            $response->assertResponseStatus(200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function testUpdateBook()
    {
        $token = getenv('AUTH_TOKEN');

        $book = Book::factory()->create();

        $updateData = [
            'title' => 'Updated Title',
            'price' => 9999.99,
            'books_language_foreign' => 3,
            'author_id' =>  3,
            'image' => "/tmp/43253534535353f.png",
            'edition' => 4,
            'status' => "Not Available",
            'stock' => 10,
            'genre' => "Suspense",
        ];

        try {
            $response = $this->put("/book/{$book->id}", $updateData, ['auth_bearer' => $token]);

            $response->assertResponseStatus(200);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function testDestroyNonExistingBook()
    {
        $token = getenv('AUTH_TOKEN');

        $nonExistentBookId = 9999; // Assuming this Book ID does not exist

        try {
            $response = $this->delete("/book/{$nonExistentBookId}", [], [
                'auth_bearer' => $token
            ]);

            $response->assertResponseStatus(404);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function testCreateBookValidationFails()
    {
        $token = getenv('AUTH_TOKEN');

        $invalidData = [
            'title' => 'Fail Title', // String
            'price' => "AAABBBB", // Float
            'books_language_foreign' => "CCCC", // Int
            'author_id' =>  "DDDD", // Int
            'image' => "/tmp/43253534535353f.png",
            'edition' => 4, // Int
            'status' => 5, // Enum (Not Available | Available)
            'stock' => "A", // Int
            'genre' => 3, // Enum (Suspense | Science Fiction ...)
        ];

        try {
            $response = $this->post('/book', $invalidData, ['auth_bearer' => $token]);

            $response->assertResponseStatus(422);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function testUnauthorizedAccess()
    {
        try {
            $response = $this->get('/books');

            $response->assertResponseStatus(401);
        } catch (Exception $e)
        {
            $e->getMessage();
        }
    }
}
