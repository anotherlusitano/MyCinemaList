<x-app-layout>
    <div class="flex flex-row min-h-4/5 w-full mt-6">
        <div class="flex flex-col items-center max-w-lg w-1/4 mr-10 mt-6">
            {{-- Movie Poster --}}
            <img src="{{ $movie->picture }}" alt="{{ $movie->title }}" class="w-64 h-80 rounded">

            {{-- Content --}}
            <div class="flex-1 text-center min-w-10 mx-2">
                <a href="/movies/{{ $movie->id }}">
                    <h2 class="text-xl font-bold">{{ $movie->title }}</h2>
                </a>

                {{-- Synopsis --}}
                <p>
                    {{ $movie->synopsis }}
                </p>

            </div>
        </div>
        <div class="w-auto">
            @foreach($reviews as $review)
                <x-review-card :review="$review"/>
            @endforeach

            @if($reviews->isEmpty())
                <div class="text-center text-gray-500 mt-6">
                    <span class="text-xl">( ._.)</span>
                    <p class="text-lg font-medium">This movie has no reviews</p>
                </div>
            @endif

            {{ $reviews->links() }}
        </div>
    </div>
</x-app-layout>
