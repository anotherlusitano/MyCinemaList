<nav class="bg-gray-900 text-white px-10 py-3 flex items-center justify-between">
    <!-- Logo -->
    <a class="text-2xl font-bold font-poetsen" href="/">
        MyCinemaList
    </a>

    <!-- Search -->
    <div class="flex items-center space-x-2 bg-gray-800 rounded-md px-2 py-1">
        <select class="bg-transparent text-white text-sm focus:outline-none">
            <option>All</option>
            <option>People</option>
            <option>Movies</option>
            <option>Users</option>
        </select>
        <input
            type="text"
            placeholder="Pesquise..."
            class="bg-transparent text-sm text-white placeholder-gray-400 focus:outline-none w-48"
        />
        <button class="text-white focus:outline-none">
            <x-tabler-search/>
        </button>
    </div>

    <!-- Profile Icon -->
    @if(Auth::check())
        <div class="ml-4">
            <div class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center">
                <!-- Simple user icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5.121 17.804A9.956 9.956 0 0112 15c2.21 0 4.247.715 5.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
        </div>
    @else
        <a href="/login" class="bg-indigo-500 hover:bg-indigo-600 text-black font-medium py-2 w-40 text-xl text-center">
            Login
        </a>
    @endif
</nav>
