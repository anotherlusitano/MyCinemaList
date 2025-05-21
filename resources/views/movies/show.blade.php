<x-app-layout>
    <div class="flex bg-white p-6">
        <div class="flex flex-col items-center">
            {{-- Movie Poster --}}
            <img src="{{ $movie->picture }}" alt="{{ $movie->title }}" class="w-64 h-80 rounded">

            {{-- Favorite Button --}}
            @if(Auth::check())

                @if(Auth::user()->hasFavoriteMovie($movie))
                    <div class="mt-4">
                        <input form="add-favorite-form" type="hidden" name="movie_id" value="{{ $movie->id }}">
                        <button form="add-favorite-form"
                                class="flex items-center text-blue-600 font-semibold hover:underline">
                            <x-gmdi-favorite-border-s class="w-6 h-6"/>
                            Add favorite
                        </button>
                    </div>
                @else
                    <div class="mt-4">
                        <input form="remove-favorite-form" type="hidden" name="movie_id" value="{{ $movie->id }}">
                        <button form="remove-favorite-form"
                                class="flex items-center text-blue-600 font-semibold hover:underline">
                            <x-gmdi-favorite-s class="w-6 h-6"/>
                            Remove favorite
                        </button>
                    </div>
                @endif
            @endif
        </div>

        {{-- Content --}}
        <div class="flex-1 mr-1 md:ml-6">
            <h2 class="text-2xl font-bold">{{ $movie->title }} ({{ $movie->release_year }})</h2>

            {{-- Stars + Score --}}
            <x-score-stars
                :score="$score"
            />

            {{-- Synopsis --}}
            <p class="max-w-xl">
                <span class="font-semibold">Sinopse</span>
                <br>
                {{ $movie->synopsis }}
            </p>

            {{-- Details --}}
            <div class="mt-4 space-y-1 text-sm text-gray-700">
                <p><span class="font-semibold">Duration:</span> {{ $movie->duration }} minutos</p>
                <p><span class="font-semibold">Rating:</span> {{ $movie->rating }}</p>
                <p><span class="font-semibold">Status:</span> {{ $movie->status }}</p>
                <p>
                    <span class="font-semibold">Genres:</span>
                    @foreach($movie->genres as $genre)
                        {{ $genre->name }},
                    @endforeach
                </p>
            </div>
        </div>

        {{-- Staff --}}
        <div>
            <h2 class="text-2xl font-semibold mb-4">Staff</h2>

            {{-- Staff Details --}}
            <ul class="space-y-1">
                @foreach ($staff->take(4) as $member)
                    @php
                        $person = $member->person;

                        $person_name = $person->first_name . " " . $person->last_name;
                        $person_picture = $person->picture;
                    @endphp

                    <li class="flex items-center bg-gray-100 even:bg-white p-2">
                        <img src="{{ $person_picture }}" alt="{{ $person_name }}"
                             class="w-16 h-16 object-cover rounded mr-4">
                        <div>
                            <a href="/people/{{ $person->id }}"
                               class="text-blue-600 font-medium hover:underline">{{ $person_name }}</a>
                            <div class="text-gray-700 text-sm">{{ $member->role }}</div>
                        </div>
                    </li>
                @endforeach
            </ul>

            @if($staff->isEmpty())
                <div class="text-center text-gray-500">
                    <span class="text-xl">( ._.)</span>
                    <p class="text-lg font-medium">This movie has no staff</p>
                </div>
            @endif

            {{-- More Staff --}}
            @if(count($staff) > 4)
                <div class="text-center mt-4">
                    <a href="/movies/{{ $movie->id }}/staff" class="text-blue-600 hover:underline">More staff</a>
                </div>
            @endif
        </div>
    </div>

    <form method="POST" action="/movies/{{ $movie->id }}/favorite" id="add-favorite-form" class="hidden">
        @csrf
    </form>

    <form method="POST" action="/movies/{{ $movie->id }}/remove-favorite" id="remove-favorite-form" class="hidden">
        @csrf
        @method('DELETE')

    </form>
</x-app-layout>
