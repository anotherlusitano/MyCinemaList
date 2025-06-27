@props(['movie'])

@if(Auth::user()->hasFavoriteMovie($movie))
    <div class="mt-4">
        <input form="add-favorite-form" type="hidden" name="movie_id" value="{{ $movie->id }}">
        <button form="add-favorite-form"
                class="flex items-center text-blue-600 font-semibold hover:underline">
            <x-gmdi-favorite-border-s class="w-6 h-6"/>
            Add favorite
        </button>
    </div>
@else
    <div class="mt-4">
        <input form="remove-favorite-form" type="hidden" name="movie_id" value="{{ $movie->id }}">
        <button form="remove-favorite-form"
                class="flex items-center text-blue-600 font-semibold hover:underline">
            <x-gmdi-favorite-s class="w-6 h-6"/>
            Remove favorite
        </button>
    </div>
@endif

<form method="POST" action="/movies/{{ $movie->id }}/favorite" id="add-favorite-form" class="hidden">
    @csrf
</form>

<form method="POST" action="/movies/{{ $movie->id }}/remove-favorite" id="remove-favorite-form" class="hidden">
    @csrf
    @method('DELETE')

</form>
