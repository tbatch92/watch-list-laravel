<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MovieList extends Model
{
    use HasFactory;

    function movies()
    {
        return $this->belongsToMany(Movie::class)->withTimestamps();
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
