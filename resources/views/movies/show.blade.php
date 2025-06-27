<x-app-layout>
    <div class="flex bg-white p-6">
        <div class="flex flex-col items-center">
            {{-- Movie Poster --}}
            <img src="{{ asset($movie->picture) }}" alt="{{ $movie->title }}" class="w-64 h-80 rounded">

            @if(Auth::check() and Auth::user()->role !== 'admin')
                {{-- Favorite Button --}}
                <x-favorite-button :movie="$movie"></x-favorite-button>

                {{-- User Movie Progress action buttons --}}
                <x-movie-progress-buttons :movie="$movie"></x-movie-progress-buttons>
            @endif

        </div>

        {{-- Content --}}
        <div class="flex-1 mr-1 md:ml-6">
            <h2 class="text-2xl font-bold">{{ $movie->title }} ({{ $movie->release_year ?? 'N/A' }})</h2>

            {{-- Stars + Score --}}
            <x-score-stars
                :score="$score"
            />

            {{-- Synopsis --}}
            <p class="max-w-3xl">
                <span class="font-semibold">Sinopse</span>
                <br>
                {{ $movie->synopsis }}
            </p>

            {{-- Details --}}
            <div class="mt-4 mb-4 space-y-1 text-sm text-gray-700">
                <p><span class="font-semibold">Duration:</span> {{ $movie->duration }} minutos</p>
                <p><span class="font-semibold">Rating:</span> {{ $movie->rating }}</p>
                <p><span class="font-semibold">Status:</span> {{ $movie->status }}</p>
                <p><span class="font-semibold">Genres:</span></p>
                <div class="flex flex-wrap gap-1">
                    @foreach($movie->genres as $genre)
                        <div
                            class="inline-block py-1 px-4 w-auto bg-blue-600 text-white border border-black rounded">
                            {{ $genre->genre->name }}
                        </div>
                    @endforeach
                </div>
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
                        <img src="{{ asset($person_picture) }}" alt="{{ $person_name }}"
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
                @if(Auth::check() and Auth::user()->role !== 'admin')

                    @php
                        $movie_review = Auth::user()->review($movie);
                    @endphp

                    {{-- Show button and popup to edit review when the user have the review of the movie --}}
                    @if($movie_review)
                        <div x-data="{ showModal: {{ $errors->has('text') ? 'true' : 'false' }} }"
                             @keydown.escape.window="showModal = false"
                             class="flex flex-row items-center text-black hover:underline"
                        >
                            <!-- Edit review button -->
                            <span href="#"
                                  @click.prevent="showModal = true"
                                  class="flex flex-row items-center text-black hover:underline cursor-pointer">
                            <x-tabler-edit class="w-4 h-4 mr-1"/>
                            Edit review
                        </span>

                            <!-- Popup to edit review -->
                            <x-edit-review-popup :movie-id="$movie->id" :review="$movie_review"/>
                        </div>

                        {{-- Show button and popup to create review when the user doesn't have the review of the movie --}}
                    @else
                        <div x-data="{ showModal: {{ $errors->has('text') ? 'true' : 'false' }} }"
                             @keydown.escape.window="showModal = false"
                             class="flex flex-row items-center text-black hover:underline"
                        >
                            <!-- Write review button -->
                            <span href="#"
                                  @click.prevent="showModal = true"
                                  class="flex flex-row items-center text-black hover:underline cursor-pointer">
                            <x-tabler-plus class="w-4 h-4"/>
                            Write review
                        </span>

                            <!-- Popup to create review -->
                            <x-review-popup :movie-id="$movie->id"/>
                        </div>
                    @endif
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
</x-app-layout>
