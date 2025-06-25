<x-app-layout>
    <div class="flex flex-row min-h-4/5 w-full mt-6">
        <form method="GET" action="{{ route('bo-search-movies') }}"
              class="flex flex-col px-10 max-w-xs w-1/4"
        >
            <input type="hidden" name="type" value="movies">
            <div class="flex bg-gray-800 mb-6">
                <input
                    type="text"
                    name="query"
                    value="{{ request('query') }}"
                    placeholder="Pesquise..."
                    class="bg-transparent text-sm text-white placeholder-gray-400 focus:outline-none w-48"
                />
                <button type="submit"
                        class="flex justify-center items-center text-white w-full focus:outline-none">
                    <x-tabler-search/>
                </button>
            </div>
            <select name="sort" class="mb-4">
                <option value="title|asc" {{ request('sort') == 'title|asc' ? 'selected' : '' }}>A-z</option>
                <option value="title|desc" {{ request('sort') == 'title|desc' ? 'selected' : '' }}>Z-a
                </option>
                <option value="release_year|desc" {{ request('sort') == 'release_year|desc' ? 'selected' : '' }}>Recent
                </option>
                <option value="release_year|asc" {{ request('sort') == 'release_year|asc' ? 'selected' : '' }}>Oldest
                </option>
            </select>
            <select name="status" class="mb-4">
                <option value="" {{ request('status') == '' ? 'selected' : '' }}>All Status</option>
                <option value="released" {{ request('status') == 'released' ? 'selected' : '' }}>Released</option>
                <option value="unreleased" {{ request('status') == 'unreleased' ? 'selected' : '' }}>Unreleased</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <select name="rating" class="mb-4">
                <option value="" {{ request('rating') == '' ? 'selected' : '' }}>All ratings</option>
                <option value="all ages" {{ request('rating') == 'all ages' ? 'selected' : '' }}>All Ages</option>
                <option value="kids" {{ request('rating') == 'kids' ? 'selected' : '' }}>Kids</option>
                <option value="teens" {{ request('rating') == 'teens' ? 'selected' : '' }}>Teens</option>
                <option value="adults" {{ request('rating') == 'adults' ? 'selected' : '' }}>Adults</option>
            </select>
            <select name="genre" class="mb-4">
                <option value="" {{ request('genre') == '' ? 'selected' : '' }}>All genres</option>
                @foreach(\App\Models\Genre::all() as $genre)
                    <option value="{{ $genre->name }}" {{ request('genre') == $genre->name ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </form>
        <div class="w-full max-w-4xl">
            <h2 class="text-2xl font-semibold mb-4">Movies</h2>

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
