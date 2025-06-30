<x-app-layout>
    <div class="flex flex-row min-h-4/5 w-full mt-6">
        <div class="flex flex-col items-center max-w-lg w-1/4 mr-10 mt-6">
            <img src="{{ $user->picture }}" alt="{{ $user->username }}" class="w-64 h-80 rounded">

            {{-- Content --}}
            <div class="flex-1 text-center min-w-10 mx-2">
                <a href="/users/{{ $user->id }}">
                    <h2 class="text-xl font-bold">{{ $user->username }}</h2>
                </a>
            </div>
        </div>
        <div class="w-full">
            @foreach($favorites as $favorite)
                @php
                    $person = $favorite->person;
                    $person_name = $person->first_name . " " . $person->last_name;

                    $date = new \Carbon\Carbon($person->birthday);
                    $birthday = $date->isoFormat('MMMM D, YYYY');
                @endphp

                <li class="flex items-center bg-gray-100 even:bg-white p-2">
                    <img src="{{ asset($person->picture) }}" alt="{{ $person_name }}"
                         class="w-16 h-16 object-cover rounded mr-4">
                    <div>
                        <a href="/people/{{ $person->id }}"
                           class="text-blue-600 font-medium hover:underline">{{ $person_name }}</a>
                        <div class="text-gray-700 text-sm">{{ $birthday }}</div>
                    </div>
                </li>
            @endforeach

            @if($favorites->isEmpty())
                <div class="text-center text-gray-500 mt-6">
                    <span class="text-xl">( ._.)</span>
                    <p class="text-lg font-medium">This user has no favorite people</p>
                </div>
            @endif

            <div class="max-w-4xl">
                {{ $favorites->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
