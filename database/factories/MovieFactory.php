<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->company(),
            'synopsis' => fake()->text(200),
            'release_year' => fake()->year(),
            'duration' => fake()->biasedNumberBetween(35, 230),
            'picture' => 'https://picsum.photos/id/' . rand(1, 600) . '/300/450',
            'rating' => fake()->randomElement(['all ages', 'kids', 'teens', 'adults']),
            'status' => fake()->randomElement(['released', 'unreleased', 'cancelled']),
        ];
    }
}
