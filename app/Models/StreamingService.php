<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class StreamingService extends Model
{
    use HasFactory;


    static function getAllStreamingServicesFromMovieDB()
    {
        $response = Http::get("https://api.themoviedb.org/3/watch/providers/movie?api_key=" . config("moviedbapi.key"));
        $services = [];
        
        if ($response->ok()) {
            $results =  $response->json()["results"];
            foreach($results as $result) {
                array_push($services, [
                    "movie_db_id" => $result["provider_id"],
                    "name" => $result["provider_name"],
                    "image_url" => $result["logo_path"]
                ]);
            }
        }

        return $services;
    } 
}
