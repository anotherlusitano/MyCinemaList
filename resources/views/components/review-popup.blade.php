@props(['movieId'])

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
        action="/reviews/create"
        class="bg-white rounded-lg p-6 shadow-lg w-full max-w-md"
        @click.stop
    >
        @csrf

        <input type="hidden" name="movie_id" value="{{ $movieId }}">

        <h2 class="text-lg font-semibold mb-4">What you recommend?</h2>

        <div class="flex flex-col gap-2 mb-4" x-data="{ selected: '' }">
            <label>
                <input type="radio" name="recommendation" value="recommended" class="hidden" x-model="selected">
                <div :class="selected === 'recommended' ? 'bg-indigo-400 text-white' : 'bg-indigo-200 text-indigo-800'"
                     class="cursor-pointer flex items-center gap-2 px-4 py-2 rounded">
                    <x-uiw-like-o class="w-6 h-6 text-blue-600"/>
                    Recommended
                </div>
            </label>

            <label>
                <input type="radio" name="recommendation" value="mixed feelings" class="hidden" x-model="selected">
                <div :class="selected === 'mixed feelings' ? 'bg-gray-400 text-white' : 'bg-gray-200 text-gray-800'"
                     class="cursor-pointer flex items-center gap-2 px-4 py-2 rounded">
                    <x-gmdi-sentiment-neutral-r class="w-6 h-6 text-gray-600"/>
                    Mixed Feelings
                </div>
            </label>

            <label>
                <input type="radio" name="recommendation" value="not recommended" class="hidden" x-model="selected">
                <div :class="selected === 'not recommended' ? 'bg-red-400 text-white' : 'bg-red-200 text-red-800'"
                     class="cursor-pointer flex items-center gap-2 px-4 py-2 rounded">
                    <x-uiw-dislike-o class="w-6 h-6 text-red-600"/>
                    Not Recommended
                </div>
            </label>

            @error("recommendation")
            <p class="mt-1 text-red-500 text-xs">
                {{ $message }}
            </p>
            @enderror
        </div>

        <label class="block font-medium mb-1">Review</label>
        <textarea name="text" required pattern=".*\S+.*" rows="4"
                  class="w-full border border-gray-300 rounded p-2 mb-4"></textarea>

        @error("text")
        <span class="text-red-500 text-sm">
            {{ $message }}
        </span>
        @enderror

        <button type="submit" class="w-full bg-indigo-500 text-white py-2 rounded hover:bg-indigo-600">
            Submit
        </button>
    </form>
</div>
