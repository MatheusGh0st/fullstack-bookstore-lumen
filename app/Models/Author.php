<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'book_id_table', 'authors_book_id', 'author_name', 'description', 'photo', 'date_of_birth'
    ];
}
