<x-app-layout>
    <div class="flex flex-row min-h-4/5 w-full mt-6">
        <div class="flex flex-col items-center max-w-lg w-1/4">
            <img src="{{ asset($movie->picture) }}" alt="{{ $movie->title }}" class="w-64 h-80 rounded">

            <h2 class="text-xl font-bold mt-2">{{ $movie->title }}</h2>

            <a href="/backoffice/genres/edit"
               class="px-8 py-2 mt-4 bg-green-600 text-white rounded-md shadow-sm hover:bg-green-700">
                Create/Delete Genres
            </a>
        </div>
        <div class="w-full max-w-4xl">
            <h2 class="text-2xl font-semibold mb-4">Genres</h2>

            <div class="flex flex-row flex-wrap">
                @foreach ($genres as $genre)
                    <li class="flex items-center w-80 bg-white border border-black mb-2 mr-2 p-2">
                        <p class="font-medium">{{ $genre->genre->name }}</p>

                        <div class="ml-auto pr-2 flex flex-row">
                            <div x-data="{ showModal: false }"
                                 @keydown.escape.window="showModal = false"
                            >
                                <!-- Button to remove genre of movie -->
                                <span href="#"
                                      @click.prevent="showModal = true"
                                      class="text-red-500 cursor-pointer">
                                                        <x-gmdi-remove class="w-6 h-6"/>
                                                    </span>

                                <!-- Popup to remove genre of movie -->
                                <x-delete-dialog :name="'the '. $genre->genre->name . ' genre'"
                                                 :remove="true"
                                                 :route="'/movie/genres/' . $genre->id . '/destroy'"/>
                            </div>
                        </div>
                    </li>
                @endforeach
            </div>

            @if($genres->isEmpty())
                <div class="max-w-fit text-center text-gray-500">
                    <span class="text-xl">:(</span>
                    <p class="text-lg font-medium">This movie doesn't have any genres...</p>
                </div>
            @endif

            <h2 class="text-2xl font-semibold mb-4 mt-12">Add Genre</h2>

            <form
                method="POST"
                action="{{ route('add-genre', $movie) }}"
            >
                @csrf

                <select name="genre">
                    @foreach($remaining_genres as $genre)
                        <option value="{{ $genre->id }}">
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                        class="px-8 py-2 ml-6 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700">
                    Add
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
