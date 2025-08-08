<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Book::factory(33)->create()->each(function ($book){
            $numReviews = random_int(5, 30);
            Review::factory()->count($numReviews)
            //sets the ratings to be good as defined in our reviewfactory
            ->good()
            ->for($book)
            ->create();
        });

        Book::factory(33)->create()->each(function ($book){
            $numReviews = random_int(5, 30);
            Review::factory()->count($numReviews)
            //sets the ratings to be good as defined in our reviewfactory
            ->average()
            ->for($book)
            ->create();
        });

        Book::factory(34)->create()->each(function ($book){
            $numReviews = random_int(5, 30);
            Review::factory()->count($numReviews)
            //sets the ratings to be good as defined in our reviewfactory
            ->bad()
            ->for($book)
            ->create();
        });
    }
}
