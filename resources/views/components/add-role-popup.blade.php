@props(['movie', 'person_id'])

<div
    x-show="showModal"
    x-transition
    x-cloak
    x-effect="document.body.style.overflow = showModal ? 'hidden' : 'auto'"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 backdrop-blur"
    @click.self="showModal = false"
>
    <form
        method="POST"
        action=""
        class="bg-white rounded-lg p-6 shadow-lg w-full max-w-md"
        @click.stop
    >
        @csrf

        <div class="w-full flex flex-col items-center text-center">
            <x-tabler-movie class="w-12 h-12 text-black"/>
            <h2 class="text-lg font-semibold mb-4">Create role for {{ $movie->title }}</h2>
            <input type="hidden" name="movie_id" value="{{ $movie->id }}">
            <input type="hidden" name="person_id" value="{{ $person_id }}">

            <input type="text" name="role"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
            @error('role')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror

            <button type="submit"
                    class="w-36 bg-green-500 text-white mt-4 py-2 rounded hover:bg-green-600">
                Create
            </button>
        </div>
    </form>
</div>
