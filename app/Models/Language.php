<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    protected $primaryKey = 'language_id';
    protected $fillable = [
        'language_name'
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
