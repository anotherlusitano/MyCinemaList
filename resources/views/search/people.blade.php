<x-app-layout>
    <div class="flex flex-row min-h-4/5 w-full mt-6">
        <div class="flex flex-col items-center max-w-lg w-1/4">
        </div>
        <div class="w-full max-w-4xl">
            <h2 class="text-2xl font-semibold mb-4">People</h2>

            @foreach ($people as $person)
                @php
                    $person_name = $person->first_name . " " . $person->last_name;

                    $date = new \Carbon\Carbon($person->birthday);
                    $birthday = $date->isoFormat('MMMM D, YYYY');
                @endphp

                <li class="flex items-center bg-gray-100 even:bg-white p-2">
                    <img src="{{ $person->picture }}" alt="{{ $person_name }}"
                         class="w-16 h-16 object-cover rounded mr-4">
                    <div>
                        <a href="/people/{{ $person->id }}"
                           class="text-blue-600 font-medium hover:underline">{{ $person_name }}</a>
                        <div class="text-gray-700 text-sm">{{ $birthday }}</div>
                    </div>
                </li>
            @endforeach

            @if($people->isEmpty())
                <div class="max-w-fit text-center text-gray-500">
                    <span class="text-xl">:(</span>
                    <p class="text-lg font-medium">Where are the people?</p>
                </div>
            @endif

            {{ $people->appends(request()->input())->links() }}
        </div>
    </div>
</x-app-layout>
