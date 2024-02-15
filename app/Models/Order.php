<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'cart_id', 'quantity', 'customer_id', 'order_date', 'address', 'status', 'payment_id'
    ];
}
