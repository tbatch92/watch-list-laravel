<?php

namespace Tests\Unit;

use App\Models\MovieList;
use App\Models\User;
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
}
