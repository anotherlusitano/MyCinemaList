<x-app-layout>
    <form
        method="POST"
        action="{{ route('update-movie', $movie) }}"
        enctype="multipart/form-data"
        class="flex flex-row min-h-4/5 w-full mt-6"
    >
        @csrf
        @method('PATCH')

        <div class="flex flex-col items-center max-w-lg w-1/4">
            <img src="{{ asset($movie->picture) }}" alt="{{ $movie->title }}" class="w-64 h-80 rounded">

            <a href="/backoffice/movies/{{ $movie->id }}/genres"
               class="px-8 py-2 mt-4 bg-green-600 text-white rounded-md shadow-sm hover:bg-green-700">
                Edit Movie Genres
            </a>
        </div>
        <div class="w-full max-w-4xl">
            <h2 class="text-2xl font-semibold mb-4">Edit Movie</h2>

            <!-- Title -->
            <div class="mt-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ $movie->title }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('title')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Synopsis -->
            <div class="mt-4">
                <label for="synopsis" class="block text-sm font-medium text-gray-700">Synopsis</label>
                <textarea name="synopsis" id="synopsis" rows="8"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $movie->synopsis }}</textarea>
                @error('synopsis')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Release Year -->
            <div class="mt-4">
                <label for="release_year" class="block text-sm font-medium text-gray-700">Release Year</label>
                <input type="number" name="release_year" id="release_year" value="{{ $movie->release_year }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('release_year')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Duration -->
            <div class="mt-4">
                <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
                <input type="number" name="duration" id="duration" value="{{ $movie->duration }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('duration')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Rating -->
            <div class="mt-4">
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                <select name="rating"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="all ages" {{ $movie->rating == 'all ages' ? 'selected' : '' }}>All Ages</option>
                    <option value="kids" {{ $movie->rating == 'kids' ? 'selected' : '' }}>Kids</option>
                    <option value="teens" {{ $movie->rating == 'teens' ? 'selected' : '' }}>Teens</option>
                    <option value="adults" {{ $movie->rating == 'adults' ? 'selected' : '' }}>Adults</option>
                </select>
                @error('rating')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mt-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="released" {{ $movie->status == 'released' ? 'selected' : '' }}>Released</option>
                    <option value="unreleased" {{ $movie->status == 'unreleased' ? 'selected' : '' }}>Unreleased
                    </option>
                    <option value="cancelled" {{ $movie->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between mt-4">
                <input type="file" id="picture" name="picture" accept="image/*">

                <button type="submit"
                        class="px-8 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700">
                    Save
                </button>
            </div>
        </div>
    </form>
</x-app-layout>
