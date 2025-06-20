@props(['id', 'title', 'release_year', 'score', 'duration', 'picture'])

<a href="/movies/{{ $id }}">
    <div class="w-80 min-w-56 rounded-xl shadow-lg bg-black">
        <img src="{{ asset($picture) }}" alt="{{ $title }}" class="w-full h-60 object-cover"/>

        <!-- Text content at bottom -->
        <div class="bottom-0 p-3 text-white text-sm">
            <h3 class="font-semibold leading-tight">{{ $title }}</h3>
            <div class="flex items-center gap-2 text-xs mt-1 text-gray-300">
                <span>{{ $release_year }}</span>
                <span>•</span>
                <span>⭐ {{ $score }}</span>
                <span>•</span>
                <span>{{ $duration }} min</span>
            </div>
        </div>
    </div>
</a>
