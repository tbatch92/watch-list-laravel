<?php

namespace Tests\Unit;

use App\Models\Movie;
use App\Models\MovieList;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_list()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
        ->withoutExceptionHandling()
             ->post(route("create-list"), ["name" => "My Movie List"])
             ->assertSessionHasNoErrors();

        $this->assertCount(1, MovieList::where(["name" => "My Movie List", "user_id" => $user->id])->get());
    }

    public function test_guest_cant_create_list()
    {
        $this->post(route("create-list"), ["name" => "My Movie List"]);
        $this->assertEmpty(MovieList::all());
    }

    public function test_unique_slug_is_created_for_duplicated_names()
    {
        $user = User::factory()->create();

        $name = "Test Name";
        $this->actingAs($user)->post(route("create-list"), ["name" => $name]);
        $this->actingAs($user)->post(route("create-list"), ["name" => $name]);

        $this->assertCount(1, MovieList::whereSlug("test-name")->get());
        $this->assertCount(1, MovieList::whereSlug("test-name-1")->get());
    }

    public function test_user_can_add_movie_to_list()
    {
        $list = MovieList::factory()->create();

        $this->actingAs($list->user)
            ->postJson(route("add-movie-to-list", ["movieList" => $list->id]), ["movie_db_id" => "1726"])
            ->assertStatus(200);
            
        $list->refresh();

        $this->assertTrue(Movie::whereMovieDbId("1726")->exists());
        $this->assertCount(1, $list->movies);
    }

    public function test_user_cant_add_to_others_list()
    {
        $list = MovieList::factory()->create();
        $otherUser = User::factory()->create();

        $this->actingAs($otherUser)
            ->postJson(route("add-movie-to-list", ["movieList" => $list->id]), ["movie_db_id" => "1726"])
            ->assertStatus(403);

        $list->refresh();

        $this->assertCount(0, $list->movies);
    }
}
