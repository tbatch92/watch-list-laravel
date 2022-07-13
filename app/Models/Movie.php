<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_db_id'
    ];

    function movieLists()
    {
        return $this->belongsToMany(MovieList::class)->withTimestamps();
    }

    static function getMovieDbDetailsForId($movieDbId)
    {
        $response = Http::get("https://api.themoviedb.org/3/movie/" . $movieDbId . "?api_key=" . config("moviedbapi.key"));
        return $response->ok() ? $response->json() : null;
    }

    protected static function booted()
    {
        static::saving(function ($movie) {
            $details = Movie::getMovieDbDetailsForId($movie->movie_db_id);

            if ($details !== null) {
                $movie->name = $details['title'];
                $movie->runtime = $details['runtime'];
                $movie->image_url = $details['poster_path'];
                $movie->release_date = Carbon::create($details["release_date"]);
            }

            return $movie;
        });
    }
}
