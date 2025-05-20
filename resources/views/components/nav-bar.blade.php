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
        <x-profile-icon/>
    @else
        <a href="/login" class="bg-indigo-500 hover:bg-indigo-600 text-black font-medium py-2 w-40 text-xl text-center">
            Login
        </a>
    @endif
</nav>
