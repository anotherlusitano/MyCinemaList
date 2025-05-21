<x-app-layout>
    <div class="flex flex-row min-h-4/5 w-full mt-6">
        @php
            $person_name = $person->first_name . " " . $person->last_name;

            $date = new \Carbon\Carbon($person->birthday);
            $birthday = $date->isoFormat('MMMM D, YYYY');
        @endphp

        {{-- Person Information --}}
        <div class="flex flex-col items-center max-w-lg w-1/4">
            <img src="{{ $person->picture }}" alt="{{ $person_name }}" class="w-64 h-80 rounded">

            <div class="flex flex-col text-center min-w-10 mx-2 mt-2">
                <h2 class="text-xl font-bold">{{ $person_name }}</h2>

                <div class="text-sm text-gray-700 mt-2">
                    <p>
                        <span class="font-semibold">Birthday:</span>
                        {{ $birthday }}
                    </p>
                    <p>
                        <span class="font-semibold">Description:</span>
                        {{ $person->description }}
                    </p>
                </div>
            </div>

            {{-- Favorite Button --}}
            @if(Auth::check())

                @if(Auth::user()->hasFavoritePerson($person))
                    <div class="mt-4">
                        <input form="add-favorite-form" type="hidden" name="person_id" value="{{ $person->id }}">
                        <button form="add-favorite-form"
                                class="flex items-center text-blue-600 font-semibold hover:underline">
                            <x-gmdi-favorite-border-s class="w-6 h-6"/>
                            Add favorite
                        </button>
                    </div>
                @else
                    <div class="mt-4">
                        <input form="remove-favorite-form" type="hidden" name="person_id" value="{{ $person->id }}">
                        <button form="remove-favorite-form"
                                class="flex items-center text-blue-600 font-semibold hover:underline">
                            <x-gmdi-favorite-s class="w-6 h-6"/>
                            Remove favorite
                        </button>
                    </div>
                @endif
            @endif
        </div>
        <div class="w-full">
            <h2 class="text-2xl font-semibold mb-4">Worked on</h2>

            @foreach ($staff as $member)
                @php
                    $movie = $member->movie;
                @endphp
                <li class="flex items-center bg-gray-100 even:bg-white p-2">
                    <img src="{{ $movie->picture }}" alt="{{ $movie->title }}"
                         class="w-16 h-16 object-cover rounded mr-4">
                    <div>
                        <a href="/movies/{{ $movie->id }}"
                           class="text-blue-600 font-medium hover:underline">{{ $movie->title }}</a>

                        <div class="text-sm text-gray-700">
                            <p><span class="font-semibold">Role:</span> {{ $member->role}}</p>
                        </div>
                    </div>
                </li>
            @endforeach

            @if($staff->isEmpty())
                <div class="max-w-fit text-center text-gray-500">
                    <span class="text-xl">¯\_(ツ)_/¯</span>
                    <p class="text-lg font-medium">This person hasn't worked on any movies</p>
                </div>
            @endif

            {{ $staff->links() }}
        </div>
    </div>

    <form method="POST" action="/people/{{ $person->id }}/favorite" id="add-favorite-form" class="hidden">
        @csrf
    </form>

    <form method="POST" action="/people/{{ $person->id }}/remove-favorite" id="remove-favorite-form" class="hidden">
        @csrf
        @method('DELETE')

    </form>
</x-app-layout>
