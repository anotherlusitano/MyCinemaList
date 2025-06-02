<x-app-layout>
    <div class="flex bg-white p-6">
        <div class="flex flex-col items-center">
            {{-- Movie Poster --}}
            <img src="{{ $user->picture }}" alt="{{ $user->username }}" class="w-64 h-80 rounded">

            <h3 class="text-xl font-bold">{{ $user->username }}</h3>
        </div>

        {{-- Content --}}
        <div class="flex-1 mr-1 md:ml-6">

            <x-movie-status-chart :movieProgressList="$movieProgressList"/>

            <div class="mt-4 mb-6 flex flex-row text-center">
                <x-gmdi-expand-more-o class="w-6 h-6"/>
                <a href="#">All movie status</a>
            </div>

            <h2 class="text-2xl font-semibold">Favorite Movies</h2>

            <div class="flex flex-row gap-2 mt-2">
                @foreach ($favoriteMovies->take(5) as $favorite)
                    <a href="/movies/{{ $favorite->movie->id }}">
                        <img src="{{ $favorite->movie->picture }}" alt="{{ $favorite->movie->title }}"
                             class="w-24 h-32 object-cover rounded mr-4">
                    </a>
                @endforeach
            </div>

            @if(count($favoriteMovies) > 5)
                <div class="mt-4">
                    <a href="/search?type=movies&query={{ request()->get('query') }}"
                       class="text-blue-600 hover:underline">More Movies</a>
                </div>
            @endif

            @if($favoriteMovies->isEmpty())
                <div class="max-w-fit text-center text-gray-500">
                    <span class="text-xl">:(</span>
                    <p class="text-lg font-medium">{{ $user->username }} doesn't have any favorite movies...</p>
                </div>
            @endif

            {{-- Favorite People --}}

            <h2 class="text-2xl font-semibold mt-6">Favorite People</h2>

            <div class="flex flex-row gap-2 mt-2">
                @foreach ($favoritePeople->take(5) as $favorite)
                    <a href="/people/{{ $favorite->person->id }}">
                        <img src="{{ $favorite->person->picture }}" alt="{{ $favorite->person->first_name }}"
                             class="w-24 h-32 object-cover rounded mr-4">
                    </a>
                @endforeach
            </div>

            @if(count($favoritePeople) > 5)
                <div class="mt-4">
                    <a href="/search?type=movies&query={{ request()->get('query') }}"
                       class="text-blue-600 hover:underline">More Movies</a>
                </div>
            @endif

            @if($favoritePeople->isEmpty())
                <div class="max-w-fit text-center text-gray-500">
                    <span class="text-xl">:(</span>
                    <p class="text-lg font-medium">{{ $user->username }} doesn't have any favorite people...</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
