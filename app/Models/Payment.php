<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'payment_id_t';

    protected $fillable = [
        'customer_id', 'order_id', 'status', 'payment_method'
    ];
}
