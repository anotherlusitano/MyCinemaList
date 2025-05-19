<x-app-layout>
    <div class="flex bg-white p-6 rounded shadow-lg max-w-4xl mx-auto">
        {{-- Movie Poster --}}
        <img src="{{ $movie->picture }}" alt="{{ $movie->title }}" class="w-48 h-auto rounded mb-4 md:mb-0 md:mr-6">

        {{-- Content --}}
        <div class="flex-1">
            <h2 class="text-2xl font-bold">{{ $movie->title }} ({{ $movie->release_year }})</h2>

            {{-- Stars + Score --}}
            <x-score-stars
                :score="$score"
            />

            {{-- Synopsis --}}
            <p><span class="font-semibold">Sinopse</span><br>{{ $movie->synopsis }}</p>

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
    </div>
</x-app-layout>
