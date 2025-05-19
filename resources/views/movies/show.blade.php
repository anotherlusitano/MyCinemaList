<x-app-layout>
    <div class="flex bg-white p-6">
        <div class="flex flex-col items-center">
            {{-- Movie Poster --}}
            <img src="{{ $movie->picture }}" alt="{{ $movie->title }}" class="w-64 h-80 rounded">

            {{-- Favorite Button --}}
            <div class="mt-4">
                <button class="flex items-center text-blue-600 font-semibold hover:underline">
                    <svg class="w-6 h-6" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m17 21-5-4-5 4V3.889a.92.92 0 0 1 .244-.629.808.808 0 0 1 .59-.26h8.333a.81.81 0 0 1 .589.26.92.92 0 0 1 .244.63V21Z"/>
                    </svg>
                    Add favorite
                </button>
            </div>
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
                            <a href="#" class="text-blue-600 font-medium hover:underline">{{ $person_name }}</a>
                            <div class="text-gray-700 text-sm">{{ $member->role }}</div>
                        </div>
                    </li>
                @endforeach
            </ul>

            {{-- More Staff --}}
            @if(count($staff) > 4)
                <div class="text-center mt-4">
                    <a href="#" class="text-blue-600 hover:underline">More staff</a>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
