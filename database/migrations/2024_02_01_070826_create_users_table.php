<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->unique();
            $table->foreignId('city_id');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->string('user_address');
            $table->string('phone_number')->unique();
            $table->enum('role', ['Author', 'Editor', 'Publisher', 'Illustrator', 'Translator']);
            $table->string('password', 255);
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
        Schema::dropIfExists('users');
    }
}
