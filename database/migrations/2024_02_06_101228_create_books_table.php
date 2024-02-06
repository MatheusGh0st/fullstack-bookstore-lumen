<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id('book_id');
            $table->string('title');
            $table->foreignId('books_language_foreign');
            $table->date('publication_date');
            $table->foreignId('author_id');
            $table->float('price');
            $table->binary('image');
            $table->integer('edition');
            $table->enum('status', ['Available', 'Not Available']);
            $table->integer('stock');
            $table->enum('genre', ['Action', 'Adventure', 'Classics', 'Comic Book', 'Graphic Novel', 'Detective', 'Mystery', 'Fantasy', 'Historical Fiction', 'Horror', 'Literary Fiction', 'Romance', 'Science Fiction', 'Suspense', 'Thrillers', 'Fiction']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
