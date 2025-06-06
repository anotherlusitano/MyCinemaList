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
            @foreach($reviews as $review)
                <x-review-card-movie :review="$review"/>
            @endforeach

            @if($reviews->isEmpty())
                <div class="text-center text-gray-500 mt-6">
                    <span class="text-xl">( ._.)</span>
                    <p class="text-lg font-medium">This user has no reviews</p>
                </div>
            @endif

            <div class="max-w-4xl">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
