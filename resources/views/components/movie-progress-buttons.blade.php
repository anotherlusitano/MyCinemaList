@php use App\Models\UserMovieProgress; @endphp
@props(['movie'])

@if($movie->status === 'released')
    @php
        $movieProgress = UserMovieProgress::query()
            ->where('user_id', auth()->id())
            ->where('movie_id', $movie->id)
            ->first();
    @endphp

    @if (!$movieProgress)
        <x-add-to-list-button :movie-id="$movie->id"/>
    @else
        @livewire('user-movie-progress-dropdown', ['userMovieProgressId' => $movieProgress->id])

        <form method="POST" action="/user-movie-progress/{{$movieProgress->id}}/destroy" class="mt-4">
            @csrf
            @method('DELETE')
            <input type="hidden" name="movie_id" value="{{ $movie->id }}">

            <button type="submit"
                    class="flex items-center gap-2 bg-red-500 text-white text-sm font-medium px-3 py-1.5 rounded hover:bg-red-600 transition">
                <x-gmdi-remove-circle class="w-6 h-6"></x-gmdi-remove-circle>
                Remove from List
            </button>
        </form>
    @endif
@endif
