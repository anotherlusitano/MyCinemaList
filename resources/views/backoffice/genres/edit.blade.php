<x-app-layout>
    <div class="flex flex-col items-center min-h-4/5 w-full mt-6">
        <h2 class="text-2xl font-semibold mb-4">Create Genres</h2>

        <form
            method="POST"
            action="/backoffice/genres/create"
            class="flex flex-col items-center gap-4 mb-12"
        >
            @csrf

            <input type="text" name="genre" minlength="3" maxlength="40" placeholder="Genre...">

            <button type="submit"
                    class="py-2 w-32 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700">
                Create
            </button>
        </form>

        <h2 class="text-2xl font-semibold mb-4">Delete Genres</h2>

        <div class="w-full max-w-2xl flex flex-col">
            @foreach ($genres as $genre)
                <li class="flex items-center self-center w-80 bg-white border border-black mb-2 mr-2 p-2">
                    <p class="font-medium">{{ $genre->name }}</p>

                    <div class="ml-auto pr-2 flex flex-row">
                        <div x-data="{ showModal: false }"
                             @keydown.escape.window="showModal = false"
                        >
                            <!-- Button to delete genre -->
                            <span href="#"
                                  @click.prevent="showModal = true"
                                  class="text-red-500 cursor-pointer">
                                                        <x-gmdi-delete class="w-6 h-6"/>
                                                    </span>

                            <!-- Popup to delete genre -->
                            <x-delete-dialog :name="'the '. $genre->name . ' genre'"
                                             :route="'/genres/' . $genre->id . '/destroy'"/>
                        </div>
                    </div>
                </li>
            @endforeach

            @if($genres->isEmpty())
                <div class="text-center text-gray-500">
                    <span class="text-xl">:(</span>
                    <p class="text-lg font-medium">Didn't found any genres...</p>
                </div>
            @endif

            {{ $genres->links() }}
        </div>
    </div>
</x-app-layout>
