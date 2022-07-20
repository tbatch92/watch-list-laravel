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

    function streamingServices()
    {
        return $this->belongsToMany(StreamingService::class)->withTimestamps();
    }

    static function getMovieDbDetailsForId($movieDbId)
    {
        $response = Http::get("https://api.themoviedb.org/3/movie/" . $movieDbId . "?api_key=" . config("moviedbapi.key") . "&append_to_response=watch/providers");
        return $response->ok() ? $response->json() : null;
    }

    protected static function booted()
    {
        static::saving(function ($movie) {
            $details = Movie::getMovieDbDetailsForId($movie->movie_db_id);           

            if ($details !== null) {
                $streamingProviders = $details["watch/providers"]["results"]["GB"]["flatrate"] ?? [];
                $streamingProviderIds = array_map(function($result) {
                    return $result["provider_id"];
                }, $streamingProviders);

                $movie->name = $details['title'];
                $movie->runtime = $details['runtime'];
                $movie->image_url = $details['poster_path'];
                $movie->release_date = Carbon::create($details["release_date"]);
                $movie->providers = json_encode($streamingProviderIds);
            }

            return $movie;
        });

        static::saved(function ($movie) {
            $streamingProviderIds = json_decode($movie->providers);
            $services = StreamingService::whereIn("movie_db_id", $streamingProviderIds)->get();
            $movie->streamingServices()->sync($services);
        });
    }
}
