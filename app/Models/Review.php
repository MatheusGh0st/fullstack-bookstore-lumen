<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primaryKey = 'review_id';
    protected $fillable = ['customer_id', 'book_id', 'review', 'date'];
}
