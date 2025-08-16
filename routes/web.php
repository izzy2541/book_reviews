<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::resource('books', BookController::class);

// Route::get('/books', function () {
//     return 'test';
// });

Route::resource('books', BookController::class)
->only(['index', 'show']);

// Define nested resource routes for reviews under books
Route::resource('books.reviews', ReviewController::class)
    // Scoped binding: Laravel will fetch the review **within the context of the book**
    // Instead of using the review's global ID, it ensures the review belongs to the specified book
    ->scoped(['review' => 'book'])

    // Limit the routes to only 'create' and 'store'
    // 'create' → show the form to add a new review for a specific book
    // 'store'  → handle the POST request to save the new review
    ->only(['create', 'store']);


