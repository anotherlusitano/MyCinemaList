@props(['name', 'route'])

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
        action="{{ $route }}"
        class="bg-white rounded-lg p-6 shadow-lg w-full max-w-md"
        @click.stop
    >
        @csrf
        @method('delete')

        <div class="w-full flex flex-col items-center">
            <x-gmdi-warning class="w-12 h-12 text-red-600"/>
            <h2 class="text-lg font-semibold mb-4">Are you sure you want to delete {{ $name }}?</h2>
            <button type="submit"
                    class="w-36 bg-red-500 text-white py-2 rounded hover:bg-red-600">
                Yes, delete {{ $name }}
            </button>
        </div>
    </form>
</div>
