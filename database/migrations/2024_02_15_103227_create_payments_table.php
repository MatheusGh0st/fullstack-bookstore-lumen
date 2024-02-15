<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id_t');
            $table->foreignId('customer_id');
            $table->foreignId('order_id');
            $table->enum('status', ["Pending",
                "Completed", "Shipped", "Cancelled",
                "Declined", "Refunded", "Disputed"]);
            $table->enum('payment_method',
                ['Canceled_Reversal','Completed', 'Created', 'Denied',
                    'Expired', 'Failed', 'Pending', 'Refunded', 'Reversed', 'Processed', 'Voided']);
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
        Schema::dropIfExists('payments');
    }
}
