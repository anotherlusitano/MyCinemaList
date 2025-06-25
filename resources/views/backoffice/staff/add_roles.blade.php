<x-app-layout>
    <div class="flex flex-col items-center min-h-4/5 w-full mt-6">
        <h2 class="text-2xl font-semibold mb-4">Add roles to movies</h2>

        <form method="GET" action="{{ route('search_movies', $person->id) }}"
              class="flex flex-col px-10 max-w-md w-full"
        >
            <div class="flex bg-gray-800 mb-6">
                <input
                    type="text"
                    name="query"
                    value="{{ request('query') }}"
                    placeholder="Pesquise..."
                    class="bg-transparent text-sm text-white placeholder-gray-400 w-full focus:outline-none"
                />
                <button type="submit"
                        class="flex justify-center items-center text-white w-16 focus:outline-none">
                    <x-tabler-search/>
                </button>
            </div>
        </form>
        <div class="w-full max-w-4xl">
            @foreach ($movies as $movie)
                <li class="flex items-center bg-gray-100 even:bg-white p-2">
                    <img src="{{ asset($movie->picture) }}" alt="{{ $movie->title }}"
                         class="w-16 h-16 object-cover rounded mr-4">
                    <div>
                        <a href="/movies/{{ $movie->id }}"
                           class="text-blue-600 font-medium hover:underline">{{ $movie->title }}</a>

                        <div class="text-sm text-gray-700">
                            <p><span class="font-semibold">Release:</span> {{ $movie->release_year}}</p>
                        </div>
                    </div>
                    <div class="ml-auto pr-4 flex flex-row">
                        <div x-data="{ showModal: false }"
                             @keydown.escape.window="showModal = false"
                             class="mr-2"
                        >
                            <!-- Button to add role -->
                            <span href="#"
                                  @click.prevent="showModal = true"
                                  class="text-green-500 cursor-pointer">
                                <x-tabler-plus class="w-6 h-6"/>
                            </span>

                            <!-- Popup to add role -->
                            <x-add-role-popup :movie="$movie" :person_id="$person->id"/>
                        </div>
                    </div>
                </li>
            @endforeach

            @if($movies->isEmpty())
                <div class="text-center text-gray-500">
                    <span class="text-xl">:(</span>
                    <p class="text-lg font-medium">Didn't found any movies...</p>
                </div>
            @endif

            {{ $movies->appends(request()->input())->onEachSide(1)->links() }}
        </div>
    </div>
</x-app-layout>
