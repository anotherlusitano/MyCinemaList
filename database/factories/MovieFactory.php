<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\GenresOfMovie;
use App\Models\Movie;
use App\Models\Person;
use App\Models\Review;
use App\Models\Staff;
use App\Models\User;
use App\Models\UserFavoriteMovie;
use App\Models\UserMovieProgress;
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
            'synopsis' => fake()->text(1250),
            'release_year' => fake()->year(),
            'duration' => fake()->biasedNumberBetween(20, 360),
            'picture' => 'https://picsum.photos/id/' . rand(1, 200) . '/300/450',
            'rating' => fake()->randomElement(['all ages', 'kids', 'teens', 'adults']),
            'status' => fake()->randomElement(['released', 'unreleased', 'cancelled']),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Movie $movie) {
            $genres = Genre::inRandomOrder()->take(rand(1, 5))->pluck('id');

            // Attach 1–5 random genres for this movie
            foreach ($genres as $genreId) {
                GenresOfMovie::create([
                    'movie_id' => $movie->id,
                    'genre_id' => $genreId,
                ]);
            }

            $people = Person::inRandomOrder()->take(rand(3, 10))->pluck('id');

            // Attach 3–10 random staff for this movie
            foreach ($people as $personId) {
                Staff::create([
                    'movie_id' => $movie->id,
                    'person_id' => $personId,
                    'role' => fake()->jobTitle(),
                ]);
            }

            $users = User::inRandomOrder()->take(rand(3, 25))->pluck('id');

            foreach ($users as $userId) {
                // Attach 3–25 random favorites for this movie
                UserFavoriteMovie::create([
                    'movie_id' => $movie->id,
                    'user_id' => $userId,
                ]);

                if ($movie->status !== 'unreleased') {
                    // Attach 3–25 random reviews for this movie
                    Review::create([
                        'movie_id' => $movie->id,
                        'user_id' => $userId,
                        'text' => fake()->text(1000),
                        'recommendation' => fake()->randomElement([
                            'recommended',
                            'mixed feelings',
                            'not recommended'
                        ]),
                    ]);

                    $status = $this->faker->randomElement(['completed', 'dropped', 'plan-to-watch']);
                    $completed = $status === 'completed' ? $this->faker->date() : null;

                    // Attach 3–25 random progress for this movie
                    UserMovieProgress::create([
                        'movie_id' => $movie->id,
                        'user_id' => $userId,
                        'watch_status' => $status,
                        'score' => $status !== 'plan-to-watch' ? $this->faker->numberBetween(1, 10) : null,
                        'completed_watching_date' => $completed,
                    ]);
                }
            }
        });
    }
}
