<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Person;
use App\Models\Review;
use App\Models\Staff;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        Movie::factory(40)->has(
            Genre::factory(), 'genres',
        )->create();

        Review::factory(10)->create();

        Person::factory(40)->create();

        Staff::factory(10)->create();
    }
}
