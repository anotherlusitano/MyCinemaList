<x-app-layout>
    <div class="flex flex-row min-h-4/5 w-full mt-6">
        <div class="flex flex-col items-center max-w-lg w-1/4">
            {{-- Movie Poster --}}
            <img src="{{ asset($movie->picture) }}" alt="{{ $movie->title }}" class="w-64 h-80 rounded">

            {{-- Content --}}
            <div class="flex-1 text-center min-w-10 mx-2">
                <a href="/movies/{{ $movie->id }}">
                    <h2 class="text-xl font-bold">{{ $movie->title }}</h2>
                </a>

                {{-- Synopsis --}}
                <p class="line-clamp-6 mr-2">
                    {{ $movie->synopsis }}
                </p>

            </div>
        </div>
        <div class="w-full">
            @foreach ($staff as $member)
                @php
                    $person = $member->person;

                    $person_name = $person->first_name . " " . $person->last_name;
                    $person_picture = $person->picture;
                @endphp

                <li class="flex items-center bg-gray-100 even:bg-white p-2">
                    <img src="{{ $person_picture }}" alt="{{ $person_name }}"
                         class="w-16 h-16 object-cover rounded mr-4">
                    <div>
                        <a href="/people/{{ $person->id }}"
                           class="text-blue-600 font-medium hover:underline">{{ $person_name }}</a>
                        <div class="text-gray-700 text-sm">{{ $member->role }}</div>
                    </div>
                </li>
            @endforeach

            @if($staff->isEmpty())
                <div class="text-center text-gray-500">
                    <span class="text-xl">( ._.)</span>
                    <p class="text-lg font-medium">This movie has no staff</p>
                </div>
            @endif

            {{ $staff->links() }}
        </div>
    </div>
</x-app-layout>
