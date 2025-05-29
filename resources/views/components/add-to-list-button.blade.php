@props(['movieId'])

<form method="POST" action="{{ route('user-movie-progress.store') }}">
    @csrf
    <input type="hidden" name="movie_id" value="{{ $movieId }}">

    <button type="submit"
            class="flex items-center gap-2 bg-[#4F74C8] text-white text-sm font-medium px-3 py-1.5 rounded hover:bg-[#3d5fa6] transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Add to list
    </button>
</form>
