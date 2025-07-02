@php
    $currentStatus = request()->get('status', 'completed');
@endphp

<x-app-layout>
    <div class="flex flex-row min-h-4/5 w-full mt-6">
        <div class="flex flex-col items-center max-w-lg w-1/4 mr-10 mt-6">
            <img src="{{ asset($user->picture) }}" alt="{{ $user->username }}" class="w-64 h-80 rounded">

            {{-- Content --}}
            <div class="flex-1 text-center min-w-10 mx-2">
                <a href="/users/{{ $user->id }}">
                    <h2 class="text-xl font-bold">{{ $user->username }}</h2>
                </a>
            </div>
        </div>
        <div class="w-full mt-6">
            <div class="flex border-b border-gray-300 space-x-8 text-lg mb-4">
                <a
                    href="/users/{{ $user->id }}/status?status=completed"
                    class="pb-2 transition-colors duration-150
            {{ $currentStatus === 'completed' ? 'border-b-2 border-blue-700 text-gray-800 font-semibold' : 'text-gray-500 hover:text-gray-700' }}">
                    Completed
                </a>
                <a
                    href="/users/{{ $user->id }}/status?status=dropped"
                    class="pb-2 transition-colors duration-150
            {{ $currentStatus === 'dropped' ? 'border-b-2 border-blue-700 text-gray-800 font-semibold' : 'text-gray-500 hover:text-gray-700' }}">
                    Dropped
                </a>
                <a
                    href="/users/{{ $user->id }}/status?status=plan-to-watch"
                    class="pb-2 transition-colors duration-150
            {{ $currentStatus === 'plan-to-watch' ? 'border-b-2 border-blue-700 text-gray-800 font-semibold' : 'text-gray-500 hover:text-gray-700' }}">
                    Plan to Watch
                </a>
            </div>

            @foreach($progressList as $item)
                @php
                    $movie = $item->movie;
                @endphp
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

            @if($progressList->isEmpty())
                <div class="text-center text-gray-500 mt-6">
                    <span class="text-xl">:P</span>
                    <p class="text-lg font-medium">This user has no movies that {{ $currentStatus }}</p>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
