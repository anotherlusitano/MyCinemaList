<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserMovieProgress>
 */
class UserMovieProgressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['completed', 'dropped', 'plan-to-watch']);
        $completed = $status === 'completed' ? null : $this->faker->date();

        return [
            'user_id' => User::factory(),
            'movie_id' => Movie::factory(),
            'watch_status' => $status,
            'score' => $status !== 'plan-to-watch' ? $this->faker->numberBetween(1, 10) : null,
            'completed_watching_date' => $completed,
        ];
    }
}
