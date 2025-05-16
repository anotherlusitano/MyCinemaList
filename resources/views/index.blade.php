<x-app-layout>
    <div class="pl-10 pt-10 relative">
        <h3 class="font-semibold leading-tight text-black text-xl mb-2">New Movies</h3>
        <div class="flex gap-3 flex-row overflow-x-auto scroll-smooth movies-released-carousel">
            @foreach($movies_released as $movie)
                <x-poster
                    :title="$movie->title"
                    :release_year="$movie->release_year"
                    :score="round($movie->movie_progress_by_users_avg_score, 1) ?? 'N/A'"
                    :duration="$movie->duration"
                    :picture="$movie->picture"
                />
            @endforeach
        </div>
        <x-carousel-arrow direction="left" carouselClass="movies-released-carousel"/>
        <x-carousel-arrow direction="right" carouselClass="movies-released-carousel"/>
    </div>
    <div class="pl-10 pt-10 relative">
        <h3 class="font-semibold leading-tight text-black  text-xl mb-2">Top Movies</h3>
        <div class="flex gap-3 flex-row overflow-x-auto scroll-smooth top-movies-carousel">
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
        <x-carousel-arrow direction="left" carouselClass="top-movies-carousel"/>
        <x-carousel-arrow direction="right" carouselClass="top-movies-carousel"/>
    </div>
    <div class="pl-10 pt-10 relative">
        <h3 class="font-semibold leading-tight text-black text-xl mb-2">Movies to be Released</h3>
        <div class="flex gap-3 flex-row overflow-x-auto scroll-smooth movies-for-release-carousel">
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
        <x-carousel-arrow direction="left" carouselClass="movies-for-release-carousel"/>
        <x-carousel-arrow direction="right" carouselClass="movies-for-release-carousel"/>
    </div>
</x-app-layout>
