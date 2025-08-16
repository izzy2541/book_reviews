<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // $table->unsignedBigInteger('book_id');

            $table->text('review');
            $table->unsignedTinyInteger('rating');
            $table->timestamps();

            //creating relationship between books and reviews tables by defining a
            //column that will reference the other table
            //book_id is a foreign key, references here specifies which column to reference
            // $table->foreignId('book_id')->references('id')->on('books')
            //this specifies that when a book is deleted from the db, all related reviews
            //should be removed too
            // ->onDelete('cascade');
            $table->foreignId('book_id')->constrained()
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
