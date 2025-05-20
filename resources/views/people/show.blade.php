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

            <div class="flex-1 text-center min-w-10 mx-2">
                <h2 class="text-xl font-bold">{{ $person_name }}</h2>

                <div class="text-sm text-gray-700">
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

            {{ $staff->links() }}
        </div>
    </div>
</x-app-layout>
