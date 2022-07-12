<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieListAssociation extends Model
{
    use HasFactory;

    function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    function movieList()
    {
        return $this->belongsTo(MovieList::class);
    }
}
