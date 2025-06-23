@props(['staff'])

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
        action="{{ route('update-staff', $staff) }}"
        class="bg-white rounded-lg p-6 shadow-lg w-full max-w-md"
        @click.stop
    >
        @csrf
        @method('PATCH')

        <div class="w-full flex flex-col items-center text-center">
            <x-gmdi-edit class="w-12 h-12 text-blue-600"/>
            <h2 class="text-lg font-semibold mb-4">Edit role of {{ $staff->movie->title }}</h2>

            <input type="text" name="role" value="{{ $staff->role }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('role')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror

            <button type="submit"
                    class="w-36 bg-blue-500 text-white mt-4 py-2 rounded hover:bg-blue-600">
                Save
            </button>
        </div>
    </form>
</div>
