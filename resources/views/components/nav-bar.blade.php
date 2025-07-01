<nav class="bg-gray-900 text-white px-10 py-3 flex items-center justify-between">
    <!-- Logo -->
    <a class="text-2xl font-bold font-poetsen" href="/">
        MyCinemaList
    </a>

    <!-- Search -->
    <form method="GET" action="{{ route('search') }}"
          class="flex items-center space-x-2 bg-gray-800 rounded-md px-2 py-1">
        <select class="bg-transparent text-white text-sm focus:outline-none" name="type">
            <option value="all" @selected(request()->get('type') == 'all' )>All</option>
            <option value="people" @selected(request()->get('type') == 'people' )>People</option>
            <option value="movies" @selected(request()->get('type') == 'movies' )>Movies</option>
            <option value="users" @selected(request()->get('type') == 'users' )>Users</option>
        </select>
        <input
            type="text"
            name="query"
            placeholder="Search..."
            class="bg-transparent text-sm text-white placeholder-gray-400 focus:outline-none w-48"
        />
        <button type="submit" class="text-white focus:outline-none">
            <x-tabler-search/>
        </button>
    </form>

    <!-- Profile Icon -->
    @if(Auth::check())
        <x-profile-icon/>
    @else
        <a href="/login" class="bg-indigo-500 hover:bg-indigo-600 text-black font-medium py-2 w-40 text-xl text-center">
            Login
        </a>
    @endif
</nav>
