<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->name(),
            'picture' => 'https://xsgames.co/randomusers/assets/avatars/pixel/' . rand(1, 50) . '.jpg',
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'normal'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Creates an admin.
     */
    public function admin(): static
    {
        return $this->state(fn(array $attributes) => [
            'email' => 'admin@gmail.com',
            'role' => 'admin',
        ]);
    }

    /**
     * Creates a dummy account.
     */
    public function dummy(): static
    {
        return $this->state(fn(array $attributes) => [
            'email' => 'test@gmail.com',
        ]);
    }
}
