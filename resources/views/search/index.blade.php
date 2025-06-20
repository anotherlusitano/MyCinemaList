<x-app-layout>
    <div class="flex flex-col items-center min-h-4/5 w-full mt-6">
        <div class="w-full max-w-4xl">
            <h2 class="text-2xl font-semibold mb-4">Movies</h2>

            @foreach ($movies->take(5) as $movie)
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

            @if(count($movies) > 5)
                <div class="text-center mt-4">
                    <a href="/search?type=movies&query={{ request()->get('query') }}"
                       class="text-blue-600 hover:underline">More Movies</a>
                </div>
            @endif

            @if($movies->isEmpty())
                <div class="max-w-fit text-center text-gray-500">
                    <span class="text-xl">:(</span>
                    <p class="text-lg font-medium">We don't found any Movies...</p>
                </div>
            @endif
        </div>
        <div class="w-full max-w-4xl">
            <h2 class="text-2xl font-semibold mb-4">People</h2>

            @foreach ($people->take(5) as $person)
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

            @if(count($people) > 5)
                <div class="text-center mt-4">
                    <a href="/search?type=people&query={{ request()->get('query') }}"
                       class="text-blue-600 hover:underline">More People</a>
                </div>
            @endif

            @if($people->isEmpty())
                <div class="max-w-fit text-center text-gray-500">
                    <span class="text-xl">:(</span>
                    <p class="text-lg font-medium">We don't found any People...</p>
                </div>
            @endif
        </div>
        <div class="w-full max-w-4xl">
            <h2 class="text-2xl font-semibold mb-4">Users</h2>

            @foreach ($users->take(5) as $user)
                @php
                    $date = new \Carbon\Carbon($user->created_at);
                    $account_created = $date->isoFormat('MMMM D, YYYY');
                @endphp

                <li class="flex items-center bg-gray-100 even:bg-white p-2">
                    <img src="{{ asset($user->picture) }}" alt="{{ $user->username }}"
                         class="w-16 h-16 object-cover rounded mr-4">
                    <div>
                        <a href="/users/{{ $user->id }}"
                           class="text-blue-600 font-medium hover:underline">{{ $user->username }}</a>
                        <div class="text-gray-700 text-sm">Created at {{ $account_created}}</div>
                    </div>
                </li>
            @endforeach

            @if(count($users) > 5)
                <div class="text-center mt-4">
                    <a href="/search?type=users&query={{ request()->get('query') }}"
                       class="text-blue-600 hover:underline">More Users</a>
                </div>
            @endif

            @if($users->isEmpty())
                <div class="max-w-fit text-center text-gray-500">
                    <span class="text-xl">:(</span>
                    <p class="text-lg font-medium">We don't found any User...</p>
                </div>
            @endif
        </div>
</x-app-layout>
