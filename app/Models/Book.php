<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'books_language_foreign', 'publication_date', 'author_id', 'price', 'image',
        'edition', 'status', 'stock', 'genre'
    ];
}
