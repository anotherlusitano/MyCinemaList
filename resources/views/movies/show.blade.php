@php use App\Models\UserMovieProgress; @endphp
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
            <div class="mt-4 mb-4 space-y-1 text-sm text-gray-700">
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

            @if(Auth::check())
                @php
                    $movieProgress = UserMovieProgress::query()
                        ->where('user_id', auth()->id())
                        ->where('movie_id', $movie->id)
                        ->first();
                @endphp

                @if (!$movieProgress)
                    <x-add-to-list-button :movie-id="$movie->id"/>
                @else
                    @livewire('user-movie-progress-dropdown', ['userMovieProgressId' => $movieProgress->id])
                @endif
            @endif
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

    <div class="flex flex-col items-center mt-6">
        <div class="w-1/2">
            <h2 class="text-black text-xl">Reviews</h2>
            <hr class="border-black">
        </div>

        @if($movie->status === 'released')
            <div class="bg-white border border-gray-200 shadow p-4 pt-2 rounded-md flex justify-between w-1/2">
                @if(Auth::check())
                    <a href="#" class="flex flex-row items-center text-black hover:underline">
                        <span>
                            <x-tabler-plus class="w-4 h-4"/>
                        </span>
                        Write review
                    </a>
                @else
                    <div></div>
                @endif
                <div class="w-1/2">
                    <div class="flex flex-row justify-between px-2 pb-2">
                        <x-uiw-like-o class="w-6 h-6 text-blue-600"/>
                        <x-gmdi-sentiment-neutral-r class="w-6 h-6 text-gray-600"/>
                        <x-uiw-dislike-o class="w-6 h-6 text-red-600"/>
                    </div>
                    <x-recommendations-chart :reviews="$reviews"/>
                </div>
                <a href="/movies/{{ $movie->id }}/reviews"
                   class="flex flex-row items-center text-black hover:underline">
                <span>
                    <x-gmdi-arrow-forward-ios class="w-4 h-4"/>
                </span>
                    All reviews
                </a>
            </div>
        @endif

        @foreach($reviews->take(3) as $review)
            <x-review-card :review="$review"/>
        @endforeach

        @if($reviews->isEmpty())
            <div class="text-center text-gray-500 mt-6">
                <span class="text-xl">( ._.)</span>
                <p class="text-lg font-medium">This movie has no reviews</p>
            </div>
        @endif
    </div>

    <form method="POST" action="/movies/{{ $movie->id }}/favorite" id="add-favorite-form" class="hidden">
        @csrf
    </form>

    <form method="POST" action="/movies/{{ $movie->id }}/remove-favorite" id="remove-favorite-form" class="hidden">
        @csrf
        @method('DELETE')

    </form>
</x-app-layout>
