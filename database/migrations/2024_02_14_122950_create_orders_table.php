<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('card_id');
            $table->foreignId('customer_id');
            $table->foreignId('payment_id');
            $table->integer('quantity');
            $table->date('order_date');
            $table->string('address');
            $table->enum('status',
                ["Pending",
                   "Completed", "Shipped", "Cancelled",
                    "Declined", "Refunded", "Disputed"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
