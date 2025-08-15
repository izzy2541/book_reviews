<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title');
        $filter = $request->input('filter', '');

        $books = Book::when(
            $title,
            fn ($query, $title) => $query->title($title)
        );

        //match is similar to a switch statement
        $books = match ($filter) {
            'popular_last_month' => $books->popularLastMonth(),
            'popular_last_6months' => $books->popularLast6Months(),
            'highest_rated_last_month' => $books->highestRatedLastMonth(),
            'highest_rated_last_6months' => $books->highestRatedLast6Months(),
            default => $books->latest()
        };

        //arguments are key, how long you want to store the data in seconds, function that will return the actual data
        // $books = $books->get();

        // with caching you always need a key, so we need to tell the
        //caching mechanism which key we want to store data under
        //remember will see whether the file or redis server already contains the key,
        //if not, it will run function in 3rd argument.
        $cacheKey = 'books:' . $filter . ':' . $title;
        $books = Cache::remember($cacheKey, 3600, fn() => $books->get());

        return view('books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view(
            'books.show',
            // load method lets you load certain relations
            ['book' => $book->load([
                // latest is a query scope built into laravel
                'reviews' => fn ($query) => $query->latest()
            ])]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
