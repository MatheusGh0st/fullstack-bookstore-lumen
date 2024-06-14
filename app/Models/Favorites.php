<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\HasMany;
use Illuminate\Database\Eloquent\BelongsTo;

class Favorites extends Model
{
    use HasFactory;
    protected $primaryKey = 'favorite_id';
    protected $fillable = [
        'user_id', 'book_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function books(): HasMany
    {
        return $this->hasMany(Books::class);
    }
}
