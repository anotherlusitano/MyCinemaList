<x-app-layout>
    <div class="flex flex-row min-h-4/5 w-full mt-6">
        <div class="flex flex-col items-center max-w-lg w-1/4">
        </div>
        <div class="w-full max-w-4xl">
            <h2 class="text-2xl font-semibold mb-4">Movies</h2>

            @foreach ($movies as $movie)
                <li class="flex items-center bg-gray-100 even:bg-white p-2">
                    <img src="{{ $movie->picture }}" alt="{{ $movie->title }}"
                         class="w-16 h-16 object-cover rounded mr-4">
                    <div>
                        <a href="/movies/{{ $movie->id }}"
                           class="text-blue-600 font-medium hover:underline">{{ $movie->title }}</a>

                        <div class="text-sm text-gray-700">
                            <p><span class="font-semibold">Release:</span> {{ $movie->release_year}}</p>
                        </div>
                    </div>
                </li>
            @endforeach

            @if($movies->isEmpty())
                <div class="max-w-fit text-center text-gray-500">
                    <span class="text-xl">:(</span>
                    <p class="text-lg font-medium">Where are the movies?</p>
                </div>
            @endif

            {{ $movies->appends(request()->input())->links() }}
        </div>
    </div>
</x-app-layout>
