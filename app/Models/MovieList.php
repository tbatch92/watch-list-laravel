<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MovieList extends Model
{
    use HasFactory;

    function movieListAssociation()
    {
        return $this->hasMany(MovieListAssociation::class);
    }

    function movies()
    {
        return $this->hasManyThrough(Movie::class, MovieListAssociation::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    static function createUniqueSlug($title)
    {
        $slugBase = Str::slug($title);
        $counter = 0;
        $slug = $slugBase;
        $uniqueSlugFound = false;

        do {
            if (MovieList::whereSlug($slug)->exists()) {
                $counter++;
                $slug = $slugBase . "-" . $counter;
            } else {
                $uniqueSlugFound = true;
            }
        } while (!$uniqueSlugFound);

        return $slug;
    }
}
