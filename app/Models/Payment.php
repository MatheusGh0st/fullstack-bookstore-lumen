<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;
    protected $primaryKey = 'payment_id_t';

    protected $fillable = [
        'customer_id', 'order_id', 'status', 'payment_method'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
