<x-app-layout>
    <form
        method="POST"
        action="/backoffice/staff/create"
        enctype="multipart/form-data"
        class="flex flex-row min-h-4/5 w-full mt-6"
    >
        @csrf

        <div class="flex flex-col items-center max-w-lg w-1/4">
            <img src="{{ asset('person.png') }}" alt="person" class="w-64 h-80 rounded">
        </div>
        <div class="w-full max-w-4xl">
            <h2 class="text-2xl font-semibold mb-4">Add Person</h2>

            <!-- First Name -->
            <div class="mt-4">
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" id="first_name"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('first_name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" name="last_name" id="last_name"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('last_name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Birthday -->
            <div class="mt-4">
                <label for="birthday" class="block text-sm font-medium text-gray-700">Birthday</label>
                <input type="date" name="birthday" id="birthday"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('birthday')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mt-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="8"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                @error('description')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="flex justify-between mt-4">
                <input type="file" id="picture" name="picture" accept="image/*">

                <button type="submit"
                        class="px-8 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700">
                    Add Person
                </button>
            </div>
        </div>
    </form>
</x-app-layout>
