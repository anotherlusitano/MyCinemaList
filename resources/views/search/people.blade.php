<x-app-layout>
    <div class="flex flex-row min-h-4/5 w-full mt-6">
        <form method="GET" action="{{ route('search') }}"
              class="flex flex-col px-10 max-w-xs w-1/4"
        >
            <input type="hidden" name="type" value="people">
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
                <option value="first_name|asc" {{ request('sort') == 'first_name|asc' ? 'selected' : '' }}>A-z</option>
                <option value="first_name|desc" {{ request('sort') == 'first_name|desc' ? 'selected' : '' }}>Z-a
                </option>
                <option value="birthday|asc" {{ request('sort') == 'birthday|asc' ? 'selected' : '' }}>Oldest</option>
                <option value="birthday|desc" {{ request('sort') == 'birthday|desc' ? 'selected' : '' }}>Younger
                </option>
            </select>
        </form>
        <div class="w-full max-w-4xl">
            <h2 class="text-2xl font-semibold mb-4">People</h2>

            @foreach ($people as $person)
                @php
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
