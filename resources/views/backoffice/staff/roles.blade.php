<x-app-layout>
    <div class="flex flex-row min-h-4/5 w-full mt-6">
        <div class="flex flex-col items-center max-w-lg w-1/4">
            <img src="{{ asset($person->picture) }}" alt="{{ $person->first_name }}" class="w-64 h-80 rounded">

            <a href="/backoffice/staff/{{ $person->id }}/roles/add"
               class="px-8 py-2 mt-4 bg-green-600 text-white rounded-md shadow-sm hover:bg-green-700">
                Add Movie Roles
            </a>
        </div>
        <div class="w-full max-w-4xl">
            <h2 class="text-2xl font-semibold mb-4">Movies</h2>

            @foreach ($staff as $staf)
                @php
                    $movie = $staf->movie;
                @endphp

                <li class="flex items-center bg-gray-100 even:bg-white p-2">
                    <img src="{{ asset($movie->picture) }}" alt="{{ $movie->title }}"
                         class="w-16 h-16 object-cover rounded mr-4">
                    <div>
                        <a href="/movies/{{ $movie->id }}"
                           class="text-blue-600 font-medium hover:underline">{{ $movie->title }}</a>

                        <div class="text-sm text-gray-700">
                            <p><span class="font-semibold">Role:</span> {{ $staf->role}}</p>
                        </div>
                    </div>

                    <div class="ml-auto mr-2 pr-4 flex flex-row">
                        <div x-data="{ showModal: false }"
                             @keydown.escape.window="showModal = false"
                             class="mr-2"
                        >
                            <!-- Button to edit role -->
                            <span href="#"
                                  @click.prevent="showModal = true"
                                  class="text-blue-500 cursor-pointer">
                                <x-gmdi-edit class="w-6 h-6"/>
                            </span>

                            <!-- Popup to edit role -->
                            <x-edit-role-popup :staff="$staf"/>
                        </div>
                        <div x-data="{ showModal: false }"
                             @keydown.escape.window="showModal = false"
                        >
                            <!-- Button to delete role -->
                            <span href="#"
                                  @click.prevent="showModal = true"
                                  class="text-red-500 cursor-pointer">
                                <x-gmdi-delete class="w-6 h-6"/>
                            </span>

                            <!-- Popup to delete role -->
                            <x-delete-dialog :name="$staf->role . ' role'"
                                             :route="'/staff/' . $staf->id . '/destroy'"/>
                        </div>
                    </div>
                </li>
            @endforeach

            @if($staff->isEmpty())
                <div class="max-w-fit text-center text-gray-500">
                    <span class="text-xl">:(</span>
                    <p class="text-lg font-medium">Where are the movies?</p>
                </div>
            @endif

            {{ $staff->links() }}
        </div>
    </div>
</x-app-layout>
