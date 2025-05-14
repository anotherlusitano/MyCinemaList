<x-app-layout>
    <div class="pl-10 pt-10">
        <h3 class="font-semibold leading-tight text-white text-xl mb-2">New Movies</h3>
        <div class="flex gap-3 flex-row overflow-scroll scroll-smooth">
            @foreach($movies_released as $movie)
                <x-poster
                    :title="$movie->title"
                    :release_year="$movie->release_year"
                    :score="0"
                    :duration="$movie->duration"
                    :picture="$movie->picture"
                />
            @endforeach
        </div>
    </div>
    <div class="pl-10 pt-10">
        <h3 class="font-semibold leading-tight text-white text-xl mb-2">Top Movies</h3>
        <div class="flex gap-3 flex-row overflow-scroll scroll-smooth">
            @foreach($top_movies as $movie)
                <x-poster
                    :title="$movie->title"
                    :release_year="$movie->release_year"
                    :score="round($movie->movie_progress_by_users_avg_score, 1) ?? 'N/A'"
                    :duration="$movie->duration"
                    :picture="$movie->picture"
                />
            @endforeach
        </div>
    </div>
    <div class="pl-10 pt-10">
        <h3 class="font-semibold leading-tight text-white text-xl mb-2">Movies to be Released</h3>
        <div class="flex gap-3 flex-row overflow-scroll scroll-smooth">
            @foreach($movies_for_release as $movie)
                <x-poster
                    :title="$movie->title"
                    :release_year="$movie->release_year"
                    :score="'N/A'"
                    :duration="$movie->duration"
                    :picture="$movie->picture"
                />
            @endforeach
        </div>
    </div>
</x-app-layout>
