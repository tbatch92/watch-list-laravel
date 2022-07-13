<?php

namespace Database\Factories;

use App\Models\MovieList;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MovieList>
 */
class MovieListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->name();
        
        return [
            'name' => $name,
            'slug' => MovieList::createUniqueSlug($name),
            'user_id' => User::factory()->create()->id,
        ];
    }
}
