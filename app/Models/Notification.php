<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\BelongsTo;

class Notification extends Model
{
    use HasFactory;
    protected $tableName = 'notification';
    protected $primaryKey = 'notification_id';
    protected $fillable = [
        'user_id', 'message'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
