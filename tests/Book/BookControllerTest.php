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
}
