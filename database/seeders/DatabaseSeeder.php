<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(50)->create();
        User::factory(1)->admin()->create();
        User::factory(1)->dummy()->create();

        Person::factory(100)->create();

        Genre::factory()
            ->count(20)
            ->sequence(
                ['name' => 'Adventure'],
                ['name' => 'Action'],
                ['name' => 'Drama'],
                ['name' => 'Comedy'],
                ['name' => 'Fantasy'],
                ['name' => 'Horror'],
                ['name' => 'Thriller'],
                ['name' => 'Mystery'],
                ['name' => 'Romance'],
                ['name' => 'Sci-Fi']
            )
            ->create();

        Movie::factory(200)->create();
    }
}
