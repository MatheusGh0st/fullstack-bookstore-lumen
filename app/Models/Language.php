<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $primaryKey = 'language_id';
    protected $fillable = [
        'language_name'
    ];
}
