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
    @endif
@endif
