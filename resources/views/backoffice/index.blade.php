<x-app-layout>
    <h1 class="text-3xl font-bold mt-12 mb-12 text-gray-800 text-center">Welcome back, {{ Auth::user()->username }}</h1>
    <div class="flex flex-wrap justify-center align-middle w-full h-full gap-10">
        <div class="bg-white w-72 h-80 rounded-2xl shadow p-6 flex flex-col justify-between hover:shadow-lg transition">
            <div>
                <div class="text-indigo-600 text-4xl mb-4">
                    🎬
                </div>
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Movies</h2>
                <p class="text-gray-600 text-sm">Create and manage new movie entries for the platform.</p>
            </div>
            <div class="mt-6">
                <a href="/backoffice/movies"
                   class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                    Go to Movie Form
                </a>
            </div>
        </div>
        <div class="bg-white w-72 h-80 rounded-2xl shadow p-6 flex flex-col justify-between hover:shadow-lg transition">
            <div>
                <div class="text-green-600 text-4xl mb-4">
                    👥
                </div>
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Staff</h2>
                <p class="text-gray-600 text-sm">Add directors, actors, and other staff to your database.</p>
            </div>
            <div class="mt-6">
                <a href="/backoffice/staff"
                   class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                    Go to Staff Form
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
