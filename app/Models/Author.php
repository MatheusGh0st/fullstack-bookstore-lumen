<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id_table', 'authors_book_id', 'author_name', 'description', 'photo', 'date_of_birth'
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
