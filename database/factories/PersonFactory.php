<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\User;
use App\Models\UserFavoritePerson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genre = fake()->randomElement(['male', 'female']);

        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'birthday' => fake()->date(),
            'description' => fake()->text(255),
            'picture' => 'https://xsgames.co/randomusers/assets/avatars/' . $genre . '/' . rand(1, 50) . '.jpg',
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Person $person) {
            $users = User::inRandomOrder()->take(rand(1, 10))->pluck('id');

            // Attach 1–10 random favorites for this person
            foreach ($users as $userId) {
                UserFavoritePerson::create([
                    'person_id' => $person->id,
                    'user_id' => $userId,
                ]);
            }
        });
    }
}
