<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    //fillable is a property on a model that lets you specify that some properties can be
    //mass assigned
    protected $fillable = ['review', 'rating'];

    public function book()
    {
        //specifies inverse relationship between review and book tables,
        //says that each review belongs to one book
        //would add a second argument here if adding second foreign key,
        //would usually happen when merging older table
        return $this->belongsTo(Book::class);
    }
}
