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
            <!-- Search Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.65 6.65a7.5 7.5 0 010 10.6z"/>
            </svg>
        </button>
    </div>

    <!-- Profile Icon -->
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
</nav>
