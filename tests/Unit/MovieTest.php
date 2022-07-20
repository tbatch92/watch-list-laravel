<?php

namespace Tests\Unit;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    function test_movie_details_filled_on_save()
    {
        $movie = new Movie;
        $movie->movie_db_id = 1726;
        $movie->save();

        $movie->refresh();

        $this->assertEquals("Iron Man", Movie::first()->name);
        $this->assertCount(1, $movie->streamingServices()->where("movie_db_id", "337")->get());
    }
}
