<?php

namespace Database\Seeders;

use App\Models\StreamingService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StreamingServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $streamingServices = StreamingService::getAllStreamingServicesFromMovieDB();
        StreamingService::upsert($streamingServices, ["movie_db_id"], ["name", "image_url"]);
    }
}
